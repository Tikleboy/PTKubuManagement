<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminProvisioningTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_create_command_successfully_provisions_administrator(): void
    {
        $this->artisan('admin:create', [
            '--name' => 'Super Administrator',
            '--email' => 'superadmin@kubumanagementbali.com',
            '--password' => 'SecureComplexPass123!',
        ])->assertExitCode(0);

        $user = User::where('email', 'superadmin@kubumanagementbali.com')->first();
        $this->assertNotNull($user);
        $this->assertEquals('Super Administrator', $user->name);
        $this->assertTrue(Hash::check('SecureComplexPass123!', $user->password));
    }

    public function test_admin_create_command_rejects_duplicate_email(): void
    {
        User::create([
            'name' => 'Existing Admin',
            'email' => 'existing@kubumanagementbali.com',
            'password' => Hash::make('ValidSecret123!'),
        ]);

        $this->artisan('admin:create', [
            '--name' => 'Another Admin',
            '--email' => 'existing@kubumanagementbali.com',
            '--password' => 'AnotherValidSecret123!',
        ])->assertExitCode(1);
    }

    public function test_admin_create_command_rejects_short_password(): void
    {
        $this->artisan('admin:create', [
            '--name' => 'Short Pass Admin',
            '--email' => 'shortpass@kubumanagementbali.com',
            '--password' => '12345',
        ])->assertExitCode(1);

        $this->assertNull(User::where('email', 'shortpass@kubumanagementbali.com')->first());
    }

    public function test_admin_create_command_rejects_invalid_email(): void
    {
        $this->artisan('admin:create', [
            '--name' => 'Invalid Email Admin',
            '--email' => 'not-an-email',
            '--password' => 'ValidPassword123!',
        ])->assertExitCode(1);
    }

    public function test_seeder_does_not_overwrite_existing_admin_password(): void
    {
        $customPasswordHash = Hash::make('CustomOriginalPass999!');
        User::create([
            'name' => 'Kubu Administrator',
            'email' => 'admin@kubumanagementbali.com',
            'password' => $customPasswordHash,
        ]);

        // Re-run seeder
        $this->seed(DatabaseSeeder::class);

        $user = User::where('email', 'admin@kubumanagementbali.com')->first();
        $this->assertNotNull($user);
        $this->assertTrue(Hash::check('CustomOriginalPass999!', $user->password));
        $this->assertFalse(Hash::check('admin12345', $user->password));
        $this->assertFalse(Hash::check('KubuTestPass2026!', $user->password));
    }
}
