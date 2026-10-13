<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\DatabaseSeeder;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_all_public_pages_load_successfully(): void
    {
        $routes = [
            '/',
            '/about',
            '/services',
            '/services/landscape',
            '/services/housekeeping',
            '/services/garden-maintenance',
            '/projects',
            '/projects/villa-a',
            '/gallery',
            '/career',
            '/contact',
            '/admin/login',
            '/login',
            '/robots.txt',
            '/sitemap.xml',
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);
        }
    }

    public function test_language_switch_works(): void
    {
        $response = $this->get('/lang/en');
        $response->assertSessionHas('locale', 'en');

        $responseId = $this->get('/lang/id');
        $responseId->assertSessionHas('locale', 'id');
    }

    public function test_english_localization_rendering(): void
    {
        $session = ['locale' => 'en'];

        // Home Page in English
        $response = $this->withSession($session)->get('/');
        $response->assertStatus(200);
        $response->assertSee('images/kubu/logo.png');
        $response->assertSee('favicon.ico');
        $response->assertSee('OUR PROJECTS');
        $response->assertSee('CAREERS');
        $response->assertSee('EXPLORE LANDSCAPE');
        $response->assertSee('EXPLORE HOUSEKEEPING');
        $response->assertSee('VIEW ALL PROJECTS');
        $response->assertDontSee('PELAJARI LANDSCAPE');
        $response->assertDontSee('LIHAT SEMUA PROJECT');

        // About Page in English
        $response = $this->withSession($session)->get('/about');
        $response->assertStatus(200);
        $response->assertSee('About Us');
        $response->assertSee('COMPANY PROFILE');
        $response->assertSee('VISION');
        $response->assertSee('MISSION');

        // Gallery Page in English
        $response = $this->withSession($session)->get('/gallery');
        $response->assertStatus(200);
        $response->assertSee('ALL PHOTOS');
        $response->assertDontSee('SEMUA FOTO (ALL)');

        // Career Page in English
        $response = $this->withSession($session)->get('/career');
        $response->assertStatus(200);
        $response->assertSee('Careers & Job Opportunities');
        $response->assertDontSee('Loker');
        $response->assertDontSee('Lowongan Kerja');

        // Contact Page in English
        $response = $this->withSession($session)->get('/contact');
        $response->assertStatus(200);
        $response->assertSee('CONTACT KUBU MANAGEMENT BALI');
        $response->assertSee('FAST WHATSAPP RESPONSE');
        $response->assertSee('Official Contact Information');
        $response->assertSee('Send Us a Message');
        $response->assertSee('Full Name');
        $response->assertSee('SEND MESSAGE NOW');
        $response->assertSee('+62 857-3826-1654');
        $response->assertSee('info@kubumanagementbali.com');
        $response->assertSee('Jalan Pura Banyukuning No.1');
    }

    public function test_indonesian_localization_rendering(): void
    {
        $session = ['locale' => 'id'];

        // Home Page in Indonesian
        $response = $this->withSession($session)->get('/');
        $response->assertStatus(200);
        $response->assertSee('PROYEK KAMI');
        $response->assertSee('KARIER');
        $response->assertSee('LIHAT LAYANAN LANSKAP');
        $response->assertSee('LIHAT LAYANAN TATA GRAHA');
        $response->assertSee('LIHAT SEMUA PROYEK');
        $response->assertDontSee('PELAJARI LANDSCAPE');
        $response->assertDontSee('LIHAT SEMUA PROJECT');

        // About Page in Indonesian
        $response = $this->withSession($session)->get('/about');
        $response->assertStatus(200);
        $response->assertSee('Tentang Kami');
        $response->assertSee('PROFIL PERUSAHAAN');
        $response->assertSee('I Wayan Suardika &amp; Ni Putu Devi Handayani', false);
        $response->assertSee('Merawat Keindahan, Menjaga Kenyamanan, Membangun Kepercayaan');
        $response->assertSee('VISI');
        $response->assertSee('MISI');

        // Gallery Page in Indonesian
        $response = $this->withSession($session)->get('/gallery');
        $response->assertStatus(200);
        $response->assertSee('SEMUA FOTO');
        $response->assertDontSee('SEMUA FOTO (ALL)');

        // Career Page in Indonesian
        $response = $this->withSession($session)->get('/career');
        $response->assertStatus(200);
        $response->assertSee('Karier & Lowongan Kerja');
        $response->assertDontSee('Loker');
        $response->assertDontSee('Karir &');

        // Contact Page in Indonesian
        $response = $this->withSession($session)->get('/contact');
        $response->assertStatus(200);
        $response->assertSee('HUBUNGI KUBU MANAGEMENT BALI');
        $response->assertSee('RESPON CEPAT WHATSAPP');
        $response->assertSee('Informasi Kontak Resmi');
        $response->assertSee('Kirim Pesan atau Pertanyaan');
        $response->assertSee('Nama Lengkap');
        $response->assertSee('KIRIM PESAN SEKARANG');
        $response->assertSee('+62 857-3826-1654');
        $response->assertSee('Jalan Pura Banyukuning No.1');
        $response->assertSee('info@kubumanagementbali.com');
    }

    public function test_contact_form_submission(): void
    {
        $response = $this->post('/contact/send', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '08123456789',
            'property_type' => 'Villa',
            'service_needed' => 'Landscape Maintenance',
            'message' => 'Halo saya butuh survei taman villa.',
        ]);

        $response->assertRedirect('/contact');
        $this->assertDatabaseHas('inquiries', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
        ]);
    }
}
