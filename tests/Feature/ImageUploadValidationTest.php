<?php

namespace Tests\Feature;

use App\Models\ServiceCategory;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageUploadValidationTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
        $this->admin = User::first();
        Storage::fake('public');
    }

    protected function createValidImage(string $extension): UploadedFile
    {
        $payloads = [
            'png' => base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg=='),
            'jpg' => base64_decode('/9j/4AAQSkZJRgABAQEASABIAAD/2wBDAP//////////////////////////////////////////////////////////////////////////////////////wgALCAABAAEBAREA/8QAFBABAAAAAAAAAAAAAAAAAAAAAP/aAAgBAQABPxA='),
            'webp' => base64_decode('UklGRiQAAABXRUJQVlA4IBgAAAAwAQCdASoBAAEAAwA0JaQAA3AA/vuUAAA='),
        ];

        return UploadedFile::fake()->createWithContent("test.{$extension}", $payloads[$extension] ?? $payloads['png']);
    }

    public function test_gallery_allows_valid_raster_images(): void
    {
        foreach (['png', 'jpg', 'webp'] as $ext) {
            $file = $this->createValidImage($ext);

            $response = $this->actingAs($this->admin)->post(route('admin.gallery.store'), [
                'title' => 'Gallery ' . $ext,
                'parent_group' => 'landscape',
                'image' => $file,
            ]);

            $response->assertRedirect(route('admin.gallery.index'));
            $response->assertSessionHasNoErrors();
        }
    }

    public function test_gallery_rejects_svg_upload(): void
    {
        $svgFile = UploadedFile::fake()->createWithContent(
            'vector.svg',
            '<svg xmlns="http://www.w3.org/2000/svg"><script>alert(1)</script></svg>'
        );

        $response = $this->actingAs($this->admin)->post(route('admin.gallery.store'), [
            'title' => 'SVG Test',
            'parent_group' => 'landscape',
            'image' => $svgFile,
        ]);

        $response->assertSessionHasErrors('image');
    }

    public function test_gallery_rejects_oversized_image(): void
    {
        // Limit is 5120 KB (5 MB), test with 6000 KB
        $oversizedFile = UploadedFile::fake()->create('oversized.png', 6000, 'image/png');

        $response = $this->actingAs($this->admin)->post(route('admin.gallery.store'), [
            'title' => 'Oversized Test',
            'parent_group' => 'landscape',
            'image' => $oversizedFile,
        ]);

        $response->assertSessionHasErrors('image');
    }

    public function test_company_profile_rejects_svg_and_oversized_images(): void
    {
        // SVG rejection test
        $svgFile = UploadedFile::fake()->createWithContent('badge.svg', '<svg xmlns="http://www.w3.org/2000/svg"></svg>');
        $responseSvg = $this->actingAs($this->admin)->put(route('admin.company.update'), [
            'name' => 'PT KUBU MANAGEMENT BALI',
            'tagline' => 'Tagline',
            'description' => 'Description text',
            'vision' => 'Vision text',
            'about_image' => $svgFile,
        ]);
        $responseSvg->assertSessionHasErrors('about_image');

        // Oversized rejection test (limit is 4096 KB, test with 5000 KB)
        $oversizedFile = UploadedFile::fake()->create('big_hero.jpg', 5000, 'image/jpeg');
        $responseOversized = $this->actingAs($this->admin)->put(route('admin.company.update'), [
            'name' => 'PT KUBU MANAGEMENT BALI',
            'tagline' => 'Tagline',
            'description' => 'Description text',
            'vision' => 'Vision text',
            'hero_image' => $oversizedFile,
        ]);
        $responseOversized->assertSessionHasErrors('hero_image');
    }

    public function test_project_and_service_reject_svg_uploads(): void
    {
        $svgFile = UploadedFile::fake()->createWithContent('diagram.svg', '<svg xmlns="http://www.w3.org/2000/svg"></svg>');

        // Project store rejection
        $projectResponse = $this->actingAs($this->admin)->post(route('admin.projects.store'), [
            'title' => 'Villa Project',
            'category' => 'Landscape',
            'main_image' => $svgFile,
        ]);
        $projectResponse->assertSessionHasErrors('main_image');

        // Service store rejection
        $category = ServiceCategory::first();
        $serviceResponse = $this->actingAs($this->admin)->post(route('admin.services.store'), [
            'service_category_id' => $category->id,
            'title' => 'Garden Care',
            'image' => $svgFile,
        ]);
        $serviceResponse->assertSessionHasErrors('image');
    }
}
