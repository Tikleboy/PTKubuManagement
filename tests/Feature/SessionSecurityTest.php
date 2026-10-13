<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Cookie;
use Tests\TestCase;

class SessionSecurityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    protected function getSessionCookieFromResponse($response): ?Cookie
    {
        $sessionCookieName = config('session.cookie');
        foreach ($response->headers->getCookies() as $cookie) {
            if ($cookie->getName() === $sessionCookieName) {
                return $cookie;
            }
        }
        return null;
    }

    public function test_session_cookie_has_secure_flag_when_secure_is_configured(): void
    {
        config(['session.secure' => true]);

        $response = $this->get('/login');
        $response->assertStatus(200);

        $sessionCookie = $this->getSessionCookieFromResponse($response);
        $this->assertNotNull($sessionCookie, 'Session cookie must be present on session initialization.');
        $this->assertTrue($sessionCookie->isSecure(), 'Session cookie must have Secure attribute when secure is enabled.');
    }

    public function test_session_cookie_has_httponly_and_samesite_flags(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);

        $sessionCookie = $this->getSessionCookieFromResponse($response);
        $this->assertNotNull($sessionCookie, 'Session cookie must be present.');
        $this->assertTrue($sessionCookie->isHttpOnly(), 'Session cookie must have HttpOnly attribute.');
        $this->assertEquals('lax', $sessionCookie->getSameSite(), 'Session cookie must have SameSite=lax.');
    }

    public function test_authenticated_session_persists_across_requests(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@kubumanagementbali.com',
            'password' => 'KubuTestPass2026!',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticated();

        $dashboardResponse = $this->get('/admin/dashboard');
        $dashboardResponse->assertStatus(200);
        $dashboardResponse->assertSee('Dashboard');
    }
}
