<?php

namespace Tests\Feature;

use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use App\Services\ManagedUploadService;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadedFileLifecycleTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
        $this->admin = User::where('role', User::ROLE_SUPER_ADMIN)->first();
        Storage::fake('public');
    }

    public function test_gallery_image_deletion_removes_uploaded_file(): void
    {
        Storage::disk('public')->put('uploads/gallery/test_gallery.jpg', 'fake-image-content');
        $this->assertTrue(Storage::disk('public')->exists('uploads/gallery/test_gallery.jpg'));

        $galleryCat = GalleryCategory::first();
        $image = GalleryImage::create([
            'title' => 'Test Gallery Photo',
            'parent_group' => 'landscape',
            'gallery_category_id' => $galleryCat->id,
            'image_path' => 'storage/uploads/gallery/test_gallery.jpg',
            'sort_order' => 1,
            'is_published' => true,
        ]);

        $response = $this->actingAs($this->admin)->delete("/admin/gallery/{$image->id}");
        $response->assertRedirect('/admin/gallery');
        $response->assertSessionHas('success');

        $this->assertNull(GalleryImage::find($image->id));
        $this->assertFalse(Storage::disk('public')->exists('uploads/gallery/test_gallery.jpg'));
    }

    public function test_service_deletion_removes_uploaded_file(): void
    {
        Storage::disk('public')->put('uploads/services/test_service.jpg', 'fake-service-image');
        $this->assertTrue(Storage::disk('public')->exists('uploads/services/test_service.jpg'));

        $category = ServiceCategory::first();
        $service = Service::create([
            'service_category_id' => $category->id,
            'title' => 'Temporary Service',
            'slug' => 'temp-service-test',
            'image' => 'storage/uploads/services/test_service.jpg',
            'is_published' => true,
        ]);

        $response = $this->actingAs($this->admin)->delete("/admin/services/{$service->id}");
        $response->assertRedirect('/admin/services');

        $this->assertNull(Service::find($service->id));
        $this->assertFalse(Storage::disk('public')->exists('uploads/services/test_service.jpg'));
    }

    protected function createValidImage(string $extension = 'jpg'): UploadedFile
    {
        $payloads = [
            'png' => base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg=='),
            'jpg' => base64_decode('/9j/4AAQSkZJRgABAQEASABIAAD/2wBDAP//////////////////////////////////////////////////////////////////////////////////////wgALCAABAAEBAREA/8QAFBABAAAAAAAAAAAAAAAAAAAAAP/aAAgBAQABPxA='),
            'webp' => base64_decode('UklGRiQAAABXRUJQVlA4IBgAAAAwAQCdASoBAAEAAwA0JaQAA3AA/vuUAAA='),
        ];

        return UploadedFile::fake()->createWithContent("test.{$extension}", $payloads[$extension] ?? $payloads['jpg']);
    }

    public function test_service_image_replacement_removes_old_file_and_keeps_new_file(): void
    {
        Storage::disk('public')->put('uploads/services/old_service.jpg', 'old-content');
        $this->assertTrue(Storage::disk('public')->exists('uploads/services/old_service.jpg'));

        $category = ServiceCategory::first();
        $service = Service::create([
            'service_category_id' => $category->id,
            'title' => 'Service Replace Test',
            'slug' => 'service-replace-test',
            'image' => 'storage/uploads/services/old_service.jpg',
            'is_published' => true,
        ]);

        $newImage = $this->createValidImage('jpg');

        $response = $this->actingAs($this->admin)->put("/admin/services/{$service->id}", [
            'service_category_id' => $category->id,
            'title' => 'Service Replace Test Updated',
            'image' => $newImage,
        ]);

        $response->assertRedirect('/admin/services');

        $service->refresh();
        $this->assertNotEquals('storage/uploads/services/old_service.jpg', $service->image);

        // Old file must be deleted from storage
        $this->assertFalse(Storage::disk('public')->exists('uploads/services/old_service.jpg'));

        // New file must exist on disk
        $newRelative = ManagedUploadService::normalizePath($service->image);
        $this->assertTrue(Storage::disk('public')->exists($newRelative));
    }

    public function test_project_deletion_removes_main_and_child_images(): void
    {
        Storage::disk('public')->put('uploads/projects/main.jpg', 'main-image-bytes');
        Storage::disk('public')->put('uploads/projects/child.jpg', 'child-image-bytes');

        $project = Project::create([
            'title' => 'Delete Project Test',
            'slug' => 'delete-project-test',
            'category' => 'Landscape',
            'main_image' => 'storage/uploads/projects/main.jpg',
        ]);

        ProjectImage::create([
            'project_id' => $project->id,
            'image_type' => 'before',
            'image_path' => 'storage/uploads/projects/child.jpg',
            'caption' => 'Before process',
        ]);

        $response = $this->actingAs($this->admin)->delete("/admin/projects/{$project->id}");
        $response->assertRedirect('/admin/projects');

        $this->assertNull(Project::find($project->id));
        $this->assertFalse(Storage::disk('public')->exists('uploads/projects/main.jpg'));
        $this->assertFalse(Storage::disk('public')->exists('uploads/projects/child.jpg'));
    }

    public function test_static_seeded_assets_are_never_deleted(): void
    {
        $staticPath = 'images/kubu/landscape_service.jpg';

        $this->assertFalse(ManagedUploadService::isManagedUpload($staticPath));
        $this->assertFalse(ManagedUploadService::deleteIfUnreferenced($staticPath));

        $category = ServiceCategory::first();
        $service = Service::create([
            'service_category_id' => $category->id,
            'title' => 'Static Asset Guard Test',
            'slug' => 'static-guard-test',
            'image' => $staticPath,
            'is_published' => true,
        ]);

        // Deleting record pointing to static asset must NOT attempt disk deletion
        $this->actingAs($this->admin)->delete("/admin/services/{$service->id}");
        $this->assertNull(Service::find($service->id));
    }

    public function test_shared_file_reference_is_not_deleted(): void
    {
        $sharedPath = 'uploads/gallery/shared_photo.jpg';
        Storage::disk('public')->put($sharedPath, 'shared-content');

        $galleryCat = GalleryCategory::first();

        $imageA = GalleryImage::create([
            'title' => 'Photo A',
            'parent_group' => 'landscape',
            'gallery_category_id' => $galleryCat->id,
            'image_path' => 'storage/' . $sharedPath,
        ]);

        $imageB = GalleryImage::create([
            'title' => 'Photo B',
            'parent_group' => 'landscape',
            'gallery_category_id' => $galleryCat->id,
            'image_path' => 'storage/' . $sharedPath,
        ]);

        // Delete Image A only
        $this->actingAs($this->admin)->delete("/admin/gallery/{$imageA->id}");
        $this->assertNull(GalleryImage::find($imageA->id));

        // File must STILL exist because Image B references it
        $this->assertTrue(Storage::disk('public')->exists($sharedPath));

        // Now delete Image B
        $this->actingAs($this->admin)->delete("/admin/gallery/{$imageB->id}");
        $this->assertNull(GalleryImage::find($imageB->id));

        // Now file has zero references and must be deleted
        $this->assertFalse(Storage::disk('public')->exists($sharedPath));
    }

    public function test_missing_files_on_disk_are_handled_gracefully(): void
    {
        $missingPath = 'storage/uploads/gallery/nonexistent_file.jpg';

        $galleryCat = GalleryCategory::first();
        $image = GalleryImage::create([
            'title' => 'Missing File Record',
            'parent_group' => 'housekeeping',
            'gallery_category_id' => $galleryCat->id,
            'image_path' => $missingPath,
        ]);

        // Deletion must complete cleanly without throwing exceptions
        $response = $this->actingAs($this->admin)->delete("/admin/gallery/{$image->id}");
        $response->assertRedirect('/admin/gallery');
        $this->assertNull(GalleryImage::find($image->id));
    }

    public function test_project_image_replacement_cleans_old_upload(): void
    {
        Storage::disk('public')->put('uploads/projects/old_main.jpg', 'old-main-content');
        $this->assertTrue(Storage::disk('public')->exists('uploads/projects/old_main.jpg'));

        $project = Project::create([
            'title' => 'Project Replace Test',
            'slug' => 'project-replace-test',
            'category' => 'Landscape',
            'main_image' => 'storage/uploads/projects/old_main.jpg',
        ]);

        $newImage = $this->createValidImage('jpg');

        $response = $this->actingAs($this->admin)->put("/admin/projects/{$project->id}", [
            'title' => 'Project Replace Test Updated',
            'category' => 'Landscape',
            'main_image' => $newImage,
        ]);

        $response->assertRedirect('/admin/projects');

        $project->refresh();
        $this->assertNotEquals('storage/uploads/projects/old_main.jpg', $project->main_image);

        // Old file must be deleted from storage
        $this->assertFalse(Storage::disk('public')->exists('uploads/projects/old_main.jpg'));

        // New file must exist on disk
        $newRelative = ManagedUploadService::normalizePath($project->main_image);
        $this->assertTrue(Storage::disk('public')->exists($newRelative));
    }

    public function test_company_profile_image_replacement_cleans_old_upload_and_preserves_static(): void
    {
        // 1. Initial seeded image is static: 'images/kubu/landscape_service.jpg'
        $company = \App\Models\CompanyProfile::first();
        $this->assertEquals('images/kubu/landscape_service.jpg', $company->about_image);

        $newImage1 = $this->createValidImage('jpg');

        // Replace static image with uploaded image
        $response = $this->actingAs($this->admin)->put('/admin/company', [
            'name' => $company->name,
            'tagline' => $company->tagline,
            'description' => $company->description,
            'vision' => $company->vision,
            'about_image' => $newImage1,
        ]);

        $response->assertRedirect('/admin/company');
        $company->refresh();
        $firstUploadPath = $company->about_image;
        $firstRelative = ManagedUploadService::normalizePath($firstUploadPath);

        $this->assertTrue(Storage::disk('public')->exists($firstRelative));

        // 2. Now replace first upload with second upload
        $newImage2 = $this->createValidImage('png');

        $response2 = $this->actingAs($this->admin)->put('/admin/company', [
            'name' => $company->name,
            'tagline' => $company->tagline,
            'description' => $company->description,
            'vision' => $company->vision,
            'about_image' => $newImage2,
        ]);

        $response2->assertRedirect('/admin/company');
        $company->refresh();

        // First upload must now be deleted from storage
        $this->assertFalse(Storage::disk('public')->exists($firstRelative));

        // Second upload must exist
        $secondRelative = ManagedUploadService::normalizePath($company->about_image);
        $this->assertTrue(Storage::disk('public')->exists($secondRelative));
    }
}
