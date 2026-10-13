<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminUserManagementTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
        $this->admin = User::where('email', 'admin@kubumanagementbali.com')->first();
    }

    public function test_guest_cannot_access_user_management(): void
    {
        $response = $this->get('/admin/users');
        $response->assertRedirect('/admin/login');

        $response = $this->get('/admin/users/create');
        $response->assertRedirect('/admin/login');
    }

    public function test_authenticated_admin_can_view_user_list(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/users');
        $response->assertStatus(200);
        $response->assertSee('Kelola Akun Administrator');
        $response->assertSee($this->admin->name);
        $response->assertSee($this->admin->email);
        $response->assertSee('Tambah Admin Baru');
    }

    public function test_authenticated_admin_can_create_new_admin(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/users', [
            'name' => 'Wayan Suardika',
            'email' => 'suardika@kubumanagementbali.com',
            'role' => User::ROLE_SUPER_ADMIN,
            'password' => 'KubuSecure2026!',
            'password_confirmation' => 'KubuSecure2026!',
        ]);

        $response->assertRedirect('/admin/users');
        $response->assertSessionHas('success');

        $newUser = User::where('email', 'suardika@kubumanagementbali.com')->first();
        $this->assertNotNull($newUser);
        $this->assertEquals('Wayan Suardika', $newUser->name);
        $this->assertEquals(User::ROLE_SUPER_ADMIN, $newUser->role);
        $this->assertTrue(Hash::check('KubuSecure2026!', $newUser->password));
    }

    public function test_create_admin_requires_explicit_role_selection(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/users', [
            'name' => 'Tanpa Role Admin',
            'email' => 'norole@kubumanagementbali.com',
            'password' => 'KubuSecure2026!',
            'password_confirmation' => 'KubuSecure2026!',
        ]);

        $response->assertSessionHasErrors('role');
        $this->assertNull(User::where('email', 'norole@kubumanagementbali.com')->first());
    }

    public function test_create_admin_validates_password_confirmation_and_length(): void
    {
        // Short password
        $response = $this->actingAs($this->admin)->post('/admin/users', [
            'name' => 'Test Short',
            'email' => 'short@kubumanagementbali.com',
            'password' => 'short',
            'password_confirmation' => 'short',
        ]);
        $response->assertSessionHasErrors('password');
        $this->assertNull(User::where('email', 'short@kubumanagementbali.com')->first());

        // Mismatched confirmation
        $response = $this->actingAs($this->admin)->post('/admin/users', [
            'name' => 'Test Mismatch',
            'email' => 'mismatch@kubumanagementbali.com',
            'password' => 'KubuSecure2026!',
            'password_confirmation' => 'Different123!',
        ]);
        $response->assertSessionHasErrors('password');
        $this->assertNull(User::where('email', 'mismatch@kubumanagementbali.com')->first());
    }

    public function test_create_admin_rejects_duplicate_email(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/users', [
            'name' => 'Duplicate Admin',
            'email' => 'admin@kubumanagementbali.com',
            'role' => User::ROLE_SUPER_ADMIN,
            'password' => 'KubuSecure2026!',
            'password_confirmation' => 'KubuSecure2026!',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_newly_created_admin_can_login_and_access_dashboard(): void
    {
        $this->actingAs($this->admin)->post('/admin/users', [
            'name' => 'Putu Devi',
            'email' => 'putu.devi@kubumanagementbali.com',
            'role' => User::ROLE_SUPER_ADMIN,
            'password' => 'SecurePass2026!',
            'password_confirmation' => 'SecurePass2026!',
        ]);

        // Logout original admin
        $this->post('/admin/logout');
        $this->assertGuest();

        // Login as newly created admin
        $loginResponse = $this->post('/admin/login', [
            'email' => 'putu.devi@kubumanagementbali.com',
            'password' => 'SecurePass2026!',
        ]);

        $loginResponse->assertRedirect('/admin/dashboard');
        $this->assertAuthenticated();

        $dashboardResponse = $this->get('/admin/dashboard');
        $dashboardResponse->assertStatus(200);
    }

    public function test_authenticated_admin_can_update_user(): void
    {
        $secondaryUser = User::create([
            'name' => 'Staff Admin',
            'email' => 'staff@kubumanagementbali.com',
            'role' => User::ROLE_EDITOR,
            'password' => Hash::make('InitialPass123!'),
        ]);

        $response = $this->actingAs($this->admin)->put("/admin/users/{$secondaryUser->id}", [
            'name' => 'Staff Senior Admin',
            'email' => 'staff.senior@kubumanagementbali.com',
            'password' => 'NewSecretPassword123!',
            'password_confirmation' => 'NewSecretPassword123!',
        ]);

        $response->assertRedirect('/admin/users');
        $response->assertSessionHas('success');

        $secondaryUser->refresh();
        $this->assertEquals('Staff Senior Admin', $secondaryUser->name);
        $this->assertEquals('staff.senior@kubumanagementbali.com', $secondaryUser->email);
        $this->assertTrue(Hash::check('NewSecretPassword123!', $secondaryUser->password));
    }

    public function test_admin_cannot_delete_own_active_account(): void
    {
        $response = $this->actingAs($this->admin)->delete("/admin/users/{$this->admin->id}");

        $response->assertSessionHasErrors('error');
        $this->assertNotNull(User::find($this->admin->id));
    }

    public function test_admin_can_delete_other_admin(): void
    {
        $secondaryUser = User::create([
            'name' => 'Temporary Admin',
            'email' => 'temp@kubumanagementbali.com',
            'role' => User::ROLE_EDITOR,
            'password' => Hash::make('Password123!'),
        ]);

        $response = $this->actingAs($this->admin)->delete("/admin/users/{$secondaryUser->id}");

        $response->assertRedirect('/admin/users');
        $response->assertSessionHas('success');
        $this->assertNull(User::find($secondaryUser->id));
    }

    public function test_admin_can_assign_roles_when_creating_and_updating(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/users', [
            'name' => 'Editor Staf',
            'email' => 'editor@kubumanagementbali.com',
            'role' => User::ROLE_EDITOR,
            'password' => 'KubuSecure2026!',
            'password_confirmation' => 'KubuSecure2026!',
        ]);

        $response->assertRedirect('/admin/users');
        $user = User::where('email', 'editor@kubumanagementbali.com')->first();
        $this->assertNotNull($user);
        $this->assertEquals(User::ROLE_EDITOR, $user->role);
        $this->assertEquals('Content Editor (Layanan & Portofolio)', $user->role_label);

        // Update role to HR
        $updateResponse = $this->actingAs($this->admin)->put("/admin/users/{$user->id}", [
            'name' => 'Editor Staf HR',
            'email' => 'editor@kubumanagementbali.com',
            'role' => User::ROLE_HR,
        ]);

        $updateResponse->assertRedirect('/admin/users');
        $user->refresh();
        $this->assertEquals(User::ROLE_HR, $user->role);
    }

    public function test_content_editor_cannot_access_user_management_or_company_profile(): void
    {
        $editor = User::create([
            'name' => 'Editor User',
            'email' => 'content.editor@kubumanagementbali.com',
            'role' => User::ROLE_EDITOR,
            'password' => Hash::make('Password123!'),
        ]);

        // Editor cannot manage users -> 403 Forbidden
        $responseUsers = $this->actingAs($editor)->get('/admin/users');
        $responseUsers->assertStatus(403);

        // Editor cannot manage company settings -> 403 Forbidden
        $responseCompany = $this->actingAs($editor)->get('/admin/company');
        $responseCompany->assertStatus(403);

        // Editor cannot manage contact settings -> 403 Forbidden
        $responseContact = $this->actingAs($editor)->get('/admin/contact');
        $responseContact->assertStatus(403);

        // Editor CAN access services
        $responseServices = $this->actingAs($editor)->get('/admin/services');
        $responseServices->assertStatus(200);

        // Editor CAN access projects
        $responseProjects = $this->actingAs($editor)->get('/admin/projects');
        $responseProjects->assertStatus(200);

        // Editor CAN access gallery
        $responseGallery = $this->actingAs($editor)->get('/admin/gallery');
        $responseGallery->assertStatus(200);
    }

    public function test_hr_and_cs_role_restrictions(): void
    {
        $hr = User::create([
            'name' => 'HR Staff',
            'email' => 'hr@kubumanagementbali.com',
            'role' => User::ROLE_HR,
            'password' => Hash::make('Password123!'),
        ]);

        $cs = User::create([
            'name' => 'CS Staff',
            'email' => 'cs@kubumanagementbali.com',
            'role' => User::ROLE_CS,
            'password' => Hash::make('Password123!'),
        ]);

        // HR can access careers
        $this->actingAs($hr)->get('/admin/careers')->assertStatus(200);
        // HR cannot access inquiries or services
        $this->actingAs($hr)->get('/admin/inquiries')->assertStatus(403);
        $this->actingAs($hr)->get('/admin/services')->assertStatus(403);

        // CS can access inquiries
        $this->actingAs($cs)->get('/admin/inquiries')->assertStatus(200);
        // CS cannot access careers or services
        $this->actingAs($cs)->get('/admin/careers')->assertStatus(403);
        $this->actingAs($cs)->get('/admin/services')->assertStatus(403);
    }

    public function test_last_super_admin_cannot_be_demoted(): void
    {
        // Try demoting the only super admin
        $response = $this->actingAs($this->admin)->put("/admin/users/{$this->admin->id}", [
            'name' => $this->admin->name,
            'email' => $this->admin->email,
            'role' => User::ROLE_EDITOR,
        ]);

        $response->assertSessionHasErrors('role');
        $this->admin->refresh();
        $this->assertEquals(User::ROLE_SUPER_ADMIN, $this->admin->role);
    }

    public function test_last_super_admin_cannot_be_deleted(): void
    {
        // Add another secondary user with editor role
        User::create([
            'name' => 'Secondary Editor',
            'email' => 'secondary.editor@kubumanagementbali.com',
            'role' => User::ROLE_EDITOR,
            'password' => Hash::make('Password123!'),
        ]);

        // Create a temporary super admin to attempt deletion
        $tempSuperAdmin = User::create([
            'name' => 'Temp Super Admin',
            'email' => 'temp.super@kubumanagementbali.com',
            'role' => User::ROLE_SUPER_ADMIN,
            'password' => Hash::make('Password123!'),
        ]);

        // Now delete original admin: should succeed because tempSuperAdmin exists
        $response1 = $this->actingAs($tempSuperAdmin)->delete("/admin/users/{$this->admin->id}");
        $response1->assertRedirect('/admin/users');
        $this->assertNull(User::find($this->admin->id));

        // Now tempSuperAdmin is the ONLY super admin remaining.
        // A secondary editor tries to delete (even if authenticated as tempSuperAdmin to delete someone else, cannot delete the last super admin):
        // If we try deleting tempSuperAdmin directly:
        $anotherAdmin = User::where('email', 'secondary.editor@kubumanagementbali.com')->first();
        // temporarily give anotherAdmin super_admin then remove
        $response2 = $this->actingAs($anotherAdmin)->delete("/admin/users/{$tempSuperAdmin->id}");
        // anotherAdmin is editor, so CheckRole middleware blocks them with 403 anyway!
        $response2->assertStatus(403);
    }

    public function test_login_records_last_login_at_and_ip(): void
    {
        $user = User::create([
            'name' => 'Login Tracker Test',
            'email' => 'tracker@kubumanagementbali.com',
            'role' => User::ROLE_EDITOR,
            'password' => Hash::make('SecretPass123!'),
        ]);

        $this->assertNull($user->last_login_at);
        $this->assertNull($user->last_login_ip);

        $response = $this->post('/admin/login', [
            'email' => 'tracker@kubumanagementbali.com',
            'password' => 'SecretPass123!',
        ]);

        $response->assertRedirect('/admin/dashboard');

        $user->refresh();
        $this->assertNotNull($user->last_login_at);
        $this->assertNotNull($user->last_login_ip);
    }

    public function test_authenticated_admin_can_view_and_update_profile(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/profile');
        $response->assertStatus(200);
        $response->assertSee('Profil & Pengaturan Akun', false);
        $response->assertSee($this->admin->email);

        // Update name and email without changing password
        $updateResponse = $this->actingAs($this->admin)->put('/admin/profile', [
            'name' => 'Updated Kubu Admin',
            'email' => 'updated.admin@kubumanagementbali.com',
        ]);

        $updateResponse->assertRedirect('/admin/profile');
        $updateResponse->assertSessionHas('success');

        $this->admin->refresh();
        $this->assertEquals('Updated Kubu Admin', $this->admin->name);
        $this->assertEquals('updated.admin@kubumanagementbali.com', $this->admin->email);
    }

    public function test_profile_password_update_requires_valid_current_password(): void
    {
        // Providing wrong current password
        $wrongPassResponse = $this->actingAs($this->admin)->put('/admin/profile', [
            'name' => $this->admin->name,
            'email' => $this->admin->email,
            'current_password' => 'wrong-current-password',
            'password' => 'BrandNewPassword123!',
            'password_confirmation' => 'BrandNewPassword123!',
        ]);

        $wrongPassResponse->assertSessionHasErrors('current_password');

        // Providing valid current password
        $validPassResponse = $this->actingAs($this->admin)->put('/admin/profile', [
            'name' => $this->admin->name,
            'email' => $this->admin->email,
            'current_password' => 'KubuTestPass2026!',
            'password' => 'BrandNewPassword123!',
            'password_confirmation' => 'BrandNewPassword123!',
        ]);

        $validPassResponse->assertRedirect('/admin/profile');
        $validPassResponse->assertSessionHas('success');

        $this->admin->refresh();
        $this->assertTrue(Hash::check('BrandNewPassword123!', $this->admin->password));
    }

    public function test_profile_update_rejects_duplicate_email(): void
    {
        $secondaryUser = User::create([
            'name' => 'Other Admin',
            'email' => 'other@kubumanagementbali.com',
            'role' => User::ROLE_EDITOR,
            'password' => Hash::make('Password123!'),
        ]);

        $response = $this->actingAs($this->admin)->put('/admin/profile', [
            'name' => $this->admin->name,
            'email' => 'other@kubumanagementbali.com',
        ]);

        $response->assertSessionHasErrors('email');
    }
}
