<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrustedProxyTest extends TestCase
{
    use RefreshDatabase;

    public function test_untrusted_direct_connection_cannot_spoof_client_ip(): void
    {
        // Untrusted public IP directly connecting to server
        $response = $this->withServerVariables([
            'REMOTE_ADDR' => '198.51.100.1',
            'HTTP_X_FORWARDED_FOR' => '203.0.113.195',
        ])->get('/robots.txt');

        $response->assertStatus(200);

        // Verify the application resolved REMOTE_ADDR and rejected spoofed X-Forwarded-For
        $this->assertEquals('198.51.100.1', request()->ip());
    }

    public function test_untrusted_direct_connection_cannot_spoof_https_protocol(): void
    {
        // Untrusted caller claiming to be HTTPS via forwarded proto header
        $response = $this->withServerVariables([
            'REMOTE_ADDR' => '198.51.100.1',
            'HTTP_X_FORWARDED_PROTO' => 'https',
            'HTTPS' => 'off',
        ])->get('/robots.txt');

        $response->assertStatus(200);

        // Header must be ignored, request must not be identified as secure
        $this->assertFalse(request()->isSecure());
    }

    public function test_trusted_nginx_loopback_proxy_forwards_real_ip_and_https(): void
    {
        // Nginx running locally on 127.0.0.1 forwarding traffic
        $response = $this->withServerVariables([
            'REMOTE_ADDR' => '127.0.0.1',
            'HTTP_X_FORWARDED_FOR' => '203.0.113.195',
            'HTTP_X_FORWARDED_PROTO' => 'https',
        ])->get('/robots.txt');

        $response->assertStatus(200);

        // Verify real client IP is properly extracted and HTTPS is recognized
        $this->assertEquals('203.0.113.195', request()->ip());
        $this->assertTrue(request()->isSecure());
    }

    public function test_trusted_cloudflare_edge_ip_forwards_real_ip_and_https(): void
    {
        // Cloudflare edge server IP (173.245.48.15) connecting to origin
        $response = $this->withServerVariables([
            'REMOTE_ADDR' => '173.245.48.15',
            'HTTP_X_FORWARDED_FOR' => '203.0.113.195',
            'HTTP_X_FORWARDED_PROTO' => 'https',
        ])->get('/robots.txt');

        $response->assertStatus(200);

        $this->assertEquals('203.0.113.195', request()->ip());
        $this->assertTrue(request()->isSecure());
    }

    public function test_untrusted_direct_connection_cannot_bypass_rate_limiting_by_rotating_forwarded_for(): void
    {
        // An attacker at 198.51.100.1 attempts multiple logins, changing X-Forwarded-For on each attempt
        for ($i = 1; $i <= 5; $i++) {
            $response = $this->withServerVariables([
                'REMOTE_ADDR' => '198.51.100.1',
                'HTTP_X_FORWARDED_FOR' => "103.0.0.{$i}",
            ])->post('/admin/login', [
                'email' => 'admin@kubumanagementbali.com',
                'password' => 'wrongpassword',
            ]);

            // First 5 attempts return validation failure / redirect back
            $response->assertStatus(302);
        }

        // 6th attempt from the same socket IP with yet another spoofed IP
        $response = $this->withServerVariables([
            'REMOTE_ADDR' => '198.51.100.1',
            'HTTP_X_FORWARDED_FOR' => '103.0.0.99',
        ])->post('/admin/login', [
            'email' => 'admin@kubumanagementbali.com',
            'password' => 'wrongpassword',
        ]);

        // Must be throttled with HTTP 429 Too Many Requests because the socket IP is keyed
        $response->assertStatus(429);
    }
}
