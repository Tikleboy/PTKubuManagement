<?php

namespace Tests\Feature;

use App\Models\Career;
use App\Models\Inquiry;
use App\Models\Project;
use App\Models\Service;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResourceShowRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
        $this->admin = User::where('role', User::ROLE_SUPER_ADMIN)->first();
    }

    public function test_unsupported_show_routes_return_method_not_allowed_instead_of_500(): void
    {
        $service = Service::first();
        $project = Project::first();
        $career = Career::create([
            'position' => 'Landscape Gardener',
            'slug' => 'landscape-gardener',
            'employment_type' => 'Full-time',
            'location' => 'Denpasar, Bali',
            'description' => 'Description test',
            'requirements' => 'Requirements test',
        ]);

        // Accessing unsupported show routes must return 405 Method Not Allowed, never 500 BadMethodCallException
        $urls = [
            "/admin/users/{$this->admin->id}",
            "/admin/services/{$service->id}",
            "/admin/projects/{$project->id}",
            "/admin/careers/{$career->id}",
        ];

        foreach ($urls as $url) {
            $response = $this->actingAs($this->admin)->get($url);
            $response->assertStatus(405);
            $this->assertNotEquals(500, $response->getStatusCode());
        }
    }

    public function test_supported_resource_routes_remain_fully_functional(): void
    {
        $service = Service::first();
        $project = Project::first();
        $career = Career::create([
            'position' => 'Housekeeper',
            'slug' => 'housekeeper',
            'employment_type' => 'Full-time',
            'location' => 'Seminyak, Bali',
            'description' => 'Housekeeping description',
            'requirements' => 'Housekeeping requirements',
        ]);
        $inquiry = Inquiry::create([
            'name' => 'Client Test',
            'email' => 'client@example.com',
            'phone' => '+628123456789',
            'message' => 'Need landscape maintenance',
            'service_type' => 'Landscape',
        ]);

        // Users routes
        $this->actingAs($this->admin)->get('/admin/users')->assertStatus(200);
        $this->actingAs($this->admin)->get('/admin/users/create')->assertStatus(200);
        $this->actingAs($this->admin)->get("/admin/users/{$this->admin->id}/edit")->assertStatus(200);

        // Services routes
        $this->actingAs($this->admin)->get('/admin/services')->assertStatus(200);
        $this->actingAs($this->admin)->get('/admin/services/create')->assertStatus(200);
        $this->actingAs($this->admin)->get("/admin/services/{$service->id}/edit")->assertStatus(200);

        // Projects routes
        $this->actingAs($this->admin)->get('/admin/projects')->assertStatus(200);
        $this->actingAs($this->admin)->get('/admin/projects/create')->assertStatus(200);
        $this->actingAs($this->admin)->get("/admin/projects/{$project->id}/edit")->assertStatus(200);

        // Careers routes
        $this->actingAs($this->admin)->get('/admin/careers')->assertStatus(200);
        $this->actingAs($this->admin)->get('/admin/careers/create')->assertStatus(200);
        $this->actingAs($this->admin)->get("/admin/careers/{$career->id}/edit")->assertStatus(200);

        // Inquiries show route (legitimate supported show action)
        $this->actingAs($this->admin)->get("/admin/inquiries/{$inquiry->id}")->assertStatus(200);
    }
}
