<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DatabaseSeederSecurityTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        // Restore testing environment variable and application environment
        putenv('ADMIN_INITIAL_PASSWORD=KubuTestPass2026!');
        $_ENV['ADMIN_INITIAL_PASSWORD'] = 'KubuTestPass2026!';
        $_SERVER['ADMIN_INITIAL_PASSWORD'] = 'KubuTestPass2026!';
        App::detectEnvironment(fn () => 'testing');
        parent::tearDown();
    }

    public function test_production_seeding_skips_admin_creation_when_initial_password_missing(): void
    {
        // Simulate production environment with missing ADMIN_INITIAL_PASSWORD
        putenv('ADMIN_INITIAL_PASSWORD');
        unset($_ENV['ADMIN_INITIAL_PASSWORD'], $_SERVER['ADMIN_INITIAL_PASSWORD']);

        // Temporarily bind environment to production
        App::detectEnvironment(fn () => 'production');
        $this->assertTrue(app()->environment('production'));

        $this->artisan('db:seed', ['--class' => DatabaseSeeder::class, '--force' => true]);

        $admin = User::where('email', 'admin@kubumanagementbali.com')->first();
        $this->assertNull($admin, 'Production seeding must not create an admin when ADMIN_INITIAL_PASSWORD is missing.');
    }

    public function test_production_seeding_creates_admin_when_initial_password_configured(): void
    {
        putenv('ADMIN_INITIAL_PASSWORD=KubuProdSecret2026!');
        $_ENV['ADMIN_INITIAL_PASSWORD'] = 'KubuProdSecret2026!';
        $_SERVER['ADMIN_INITIAL_PASSWORD'] = 'KubuProdSecret2026!';

        App::detectEnvironment(fn () => 'production');
        $this->assertTrue(app()->environment('production'));

        $this->artisan('db:seed', ['--class' => DatabaseSeeder::class, '--force' => true]);

        $admin = User::where('email', 'admin@kubumanagementbali.com')->first();
        $this->assertNotNull($admin);
        $this->assertTrue(Hash::check('KubuProdSecret2026!', $admin->password));
        $this->assertFalse(Hash::check('admin12345', $admin->password));
    }

    public function test_seeding_does_not_fall_back_to_predictable_admin12345(): void
    {
        // When initial password is missing in testing environment
        putenv('ADMIN_INITIAL_PASSWORD');
        unset($_ENV['ADMIN_INITIAL_PASSWORD'], $_SERVER['ADMIN_INITIAL_PASSWORD']);

        $this->seed(DatabaseSeeder::class);

        // Administrator should NOT be created with predictable fallback admin12345
        $admin = User::where('email', 'admin@kubumanagementbali.com')->first();
        $this->assertNull($admin);
    }

    public function test_seeder_preserves_existing_admin_account_and_credentials(): void
    {
        $existingHash = Hash::make('CustomPreExistingPassword123!');
        User::create([
            'name' => 'Existing Company Admin',
            'email' => 'admin@kubumanagementbali.com',
            'role' => User::ROLE_SUPER_ADMIN,
            'password' => $existingHash,
        ]);

        putenv('ADMIN_INITIAL_PASSWORD=DifferentAttemptedPassword2026!');
        $_ENV['ADMIN_INITIAL_PASSWORD'] = 'DifferentAttemptedPassword2026!';

        $this->seed(DatabaseSeeder::class);

        $admin = User::where('email', 'admin@kubumanagementbali.com')->first();
        $this->assertNotNull($admin);
        $this->assertEquals('Existing Company Admin', $admin->name);
        $this->assertTrue(Hash::check('CustomPreExistingPassword123!', $admin->password));
        $this->assertFalse(Hash::check('DifferentAttemptedPassword2026!', $admin->password));
        $this->assertFalse(Hash::check('admin12345', $admin->password));
    }
}
