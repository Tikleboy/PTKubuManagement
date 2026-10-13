<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class SecurityHeadersTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_public_pages_include_security_headers(): void
    {
        $endpoints = ['/', '/services', '/contact', '/about', '/projects', '/gallery', '/career'];

        foreach ($endpoints as $url) {
            $response = $this->get($url);
            $response->assertStatus(200);

            $response->assertHeader('X-Content-Type-Options', 'nosniff');
            $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
            $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
        }
    }

    public function test_login_page_includes_security_headers(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);

        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
    }

    public function test_authenticated_admin_pages_include_security_headers(): void
    {
        $admin = User::where('role', User::ROLE_SUPER_ADMIN)->first();

        $response = $this->actingAs($admin)->get('/admin/dashboard');
        $response->assertStatus(200);

        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
    }

    public function test_security_headers_middleware_preserves_pre_existing_headers(): void
    {
        Route::middleware('web')->get('/test-custom-headers', function () {
            return response('Custom header page')
                ->header('X-Frame-Options', 'DENY')
                ->header('X-Content-Type-Options', 'custom-type')
                ->header('Referrer-Policy', 'no-referrer');
        });

        $response = $this->get('/test-custom-headers');
        $response->assertStatus(200);

        // Pre-existing headers must NOT be overridden by default middleware values
        $response->assertHeader('X-Frame-Options', 'DENY');
        $response->assertHeader('X-Content-Type-Options', 'custom-type');
        $response->assertHeader('Referrer-Policy', 'no-referrer');
    }
}
