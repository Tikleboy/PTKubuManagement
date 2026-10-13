<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PasswordPolicyTest extends TestCase
{
    use RefreshDatabase;

    protected User $superAdmin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
        $this->superAdmin = User::where('role', User::ROLE_SUPER_ADMIN)->first();
    }

    public function test_user_creation_rejects_password_shorter_than_8_characters(): void
    {
        $response = $this->actingAs($this->superAdmin)->post('/admin/users', [
            'name' => 'Short Pass Admin',
            'email' => 'shortpass@kubumanagementbali.com',
            'role' => User::ROLE_EDITOR,
            'password' => 'short1',
            'password_confirmation' => 'short1',
        ]);

        $response->assertSessionHasErrors('password');
        $this->assertNull(User::where('email', 'shortpass@kubumanagementbali.com')->first());
    }

    public function test_user_creation_rejects_known_breached_passwords(): void
    {
        $compromisedPasswords = [
            'password123',
            'Password123!',
            'qwertyuiop',
            'admin123456',
        ];

        foreach ($compromisedPasswords as $password) {
            $email = 'breached_' . substr(md5($password), 0, 8) . '@kubumanagementbali.com';
            $response = $this->actingAs($this->superAdmin)->post('/admin/users', [
                'name' => 'Compromised Test',
                'email' => $email,
                'role' => User::ROLE_EDITOR,
                'password' => $password,
                'password_confirmation' => $password,
            ]);

            $response->assertSessionHasErrors('password');
            $this->assertNull(User::where('email', $email)->first());
        }
    }

    public function test_user_creation_succeeds_with_uncompromised_password(): void
    {
        $response = $this->actingAs($this->superAdmin)->post('/admin/users', [
            'name' => 'Secure Admin Member',
            'email' => 'secure.member@kubumanagementbali.com',
            'role' => User::ROLE_EDITOR,
            'password' => 'KubuSecure2026!',
            'password_confirmation' => 'KubuSecure2026!',
        ]);

        $response->assertRedirect('/admin/users');
        $response->assertSessionHas('success');

        $created = User::where('email', 'secure.member@kubumanagementbali.com')->first();
        $this->assertNotNull($created);
        $this->assertTrue(Hash::check('KubuSecure2026!', $created->password));
    }

    public function test_user_update_rejects_compromised_password(): void
    {
        $user = User::create([
            'name' => 'Update Pass Test',
            'email' => 'updatepass@kubumanagementbali.com',
            'role' => User::ROLE_EDITOR,
            'password' => Hash::make('KubuInitialSecure2026!'),
        ]);

        $response = $this->actingAs($this->superAdmin)->put("/admin/users/{$user->id}", [
            'name' => 'Update Pass Test',
            'email' => 'updatepass@kubumanagementbali.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ]);

        $response->assertSessionHasErrors('password');
        $user->refresh();
        $this->assertTrue(Hash::check('KubuInitialSecure2026!', $user->password));
    }

    public function test_user_update_succeeds_with_uncompromised_password(): void
    {
        $user = User::create([
            'name' => 'Update Pass Success',
            'email' => 'updatesuccess@kubumanagementbali.com',
            'role' => User::ROLE_EDITOR,
            'password' => Hash::make('KubuInitialSecure2026!'),
        ]);

        $response = $this->actingAs($this->superAdmin)->put("/admin/users/{$user->id}", [
            'name' => 'Update Pass Success',
            'email' => 'updatesuccess@kubumanagementbali.com',
            'password' => 'KubuNewSecure2026!',
            'password_confirmation' => 'KubuNewSecure2026!',
        ]);

        $response->assertRedirect('/admin/users');
        $user->refresh();
        $this->assertTrue(Hash::check('KubuNewSecure2026!', $user->password));
    }

    public function test_profile_update_rejects_compromised_password(): void
    {
        $response = $this->actingAs($this->superAdmin)->put('/admin/profile', [
            'name' => $this->superAdmin->name,
            'email' => $this->superAdmin->email,
            'current_password' => 'KubuTestPass2026!',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ]);

        $response->assertSessionHasErrors('password');
        $this->superAdmin->refresh();
        $this->assertTrue(Hash::check('KubuTestPass2026!', $this->superAdmin->password));
    }

    public function test_profile_update_succeeds_with_uncompromised_password(): void
    {
        $response = $this->actingAs($this->superAdmin)->put('/admin/profile', [
            'name' => $this->superAdmin->name,
            'email' => $this->superAdmin->email,
            'current_password' => 'KubuTestPass2026!',
            'password' => 'KubuSuperSecret2026!',
            'password_confirmation' => 'KubuSuperSecret2026!',
        ]);

        $response->assertRedirect('/admin/profile');
        $response->assertSessionHas('success');

        $this->superAdmin->refresh();
        $this->assertTrue(Hash::check('KubuSuperSecret2026!', $this->superAdmin->password));
    }

    public function test_admin_create_artisan_command_rejects_compromised_password(): void
    {
        $this->artisan('admin:create', [
            '--name' => 'Artisan Breached Pass',
            '--email' => 'artisan.breached@kubumanagementbali.com',
            '--password' => 'Password123!',
        ])->assertExitCode(1);

        $this->assertNull(User::where('email', 'artisan.breached@kubumanagementbali.com')->first());
    }

    public function test_admin_create_artisan_command_accepts_uncompromised_password(): void
    {
        $this->artisan('admin:create', [
            '--name' => 'Artisan Secure Pass',
            '--email' => 'artisan.secure@kubumanagementbali.com',
            '--password' => 'KubuConsoleSecure2026!',
        ])->assertExitCode(0);

        $user = User::where('email', 'artisan.secure@kubumanagementbali.com')->first();
        $this->assertNotNull($user);
        $this->assertTrue(Hash::check('KubuConsoleSecure2026!', $user->password));
    }
}
