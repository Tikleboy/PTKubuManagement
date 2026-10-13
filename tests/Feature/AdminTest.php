<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_admin_can_login_and_access_dashboard(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@kubumanagementbali.com',
            'password' => 'KubuTestPass2026!',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticated();

        $dashboardResponse = $this->get('/admin/dashboard');
        $dashboardResponse->assertStatus(200);
    }

    public function test_guest_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/admin/login');
    }

    public function test_login_page_renders_with_empty_inputs_and_correct_autocomplete_attributes(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);

        // Ensure email input has no hardcoded value and uses autocomplete="username"
        $response->assertDontSee('value="admin@kubumanagementbali.com"', false);
        $response->assertSee('autocomplete="username"', false);

        // Ensure password input has no value attribute and uses autocomplete="current-password"
        $response->assertDontSee('value="admin12345"', false);
        $response->assertDontSee('value="KubuTestPass2026!"', false);
        $response->assertSee('autocomplete="current-password"', false);

        // Assert that the password input tag itself does not contain value=
        $content = $response->getContent();
        $this->assertMatchesRegularExpression('/<input[^>]*name="password"[^>]*>/i', $content);
        $this->assertDoesNotMatchRegularExpression('/<input[^>]*name="password"[^>]*value=/i', $content);
    }

    public function test_login_page_preserves_email_on_validation_failure_without_prefilling_password(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'typed.admin@kubumanagementbali.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('email');

        // Follow back to login page
        $loginPage = $this->get('/admin/login');
        $loginPage->assertStatus(200);
        $loginPage->assertSee('value="typed.admin@kubumanagementbali.com"', false);

        // Password must remain empty with no value attribute
        $content = $loginPage->getContent();
        $this->assertDoesNotMatchRegularExpression('/<input[^>]*name="password"[^>]*value=/i', $content);
        $loginPage->assertDontSee('wrongpassword', false);
    }
}
