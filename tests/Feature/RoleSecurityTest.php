<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RoleSecurityTest extends TestCase
{
    use RefreshDatabase;

    protected User $superAdmin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
        $this->superAdmin = User::where('email', 'admin@kubumanagementbali.com')->first();
    }

    public function test_new_in_memory_user_without_role_is_not_super_admin(): void
    {
        $userWithoutRole = new User();
        $this->assertNull($userWithoutRole->role);
        $this->assertFalse($userWithoutRole->isSuperAdmin(), 'In-memory user without role must never be super_admin.');
        $this->assertFalse($userWithoutRole->canManageUsers());
        $this->assertFalse($userWithoutRole->canManageSettings());
        $this->assertFalse($userWithoutRole->canManageContent());
        $this->assertFalse($userWithoutRole->canManageCareers());
        $this->assertFalse($userWithoutRole->canManageInquiries());
    }

    public function test_in_memory_user_with_null_empty_or_unrecognized_role_is_not_super_admin(): void
    {
        $nullRoleUser = new User(['role' => null]);
        $this->assertFalse($nullRoleUser->isSuperAdmin());

        $emptyRoleUser = new User(['role' => '']);
        $this->assertFalse($emptyRoleUser->isSuperAdmin());

        $unrecognizedUser = new User(['role' => 'guest_unrecognized']);
        $this->assertFalse($unrecognizedUser->isSuperAdmin());
    }

    public function test_account_created_without_explicit_role_receives_least_privileged_role(): void
    {
        // When inserting directly without passing 'role', the database schema default ('cs') applies
        $user = User::create([
            'name' => 'Default Role User',
            'email' => 'defaultrole@kubumanagementbali.com',
            'password' => Hash::make('Secret123!'),
        ]);

        $this->assertFalse($user->isSuperAdmin(), 'In-memory model before refresh must not be super admin.');

        $user->refresh();

        $this->assertEquals(User::ROLE_CS, $user->role, 'Database schema default must be the least-privileged cs role.');
        $this->assertFalse($user->isSuperAdmin(), 'Default role account must not be super admin.');
        $this->assertFalse($user->canManageUsers());
        $this->assertFalse($user->canManageSettings());
        $this->assertFalse($user->canManageContent());
        $this->assertFalse($user->canManageCareers());
        $this->assertTrue($user->canManageInquiries(), 'CS role can manage inquiries.');
    }

    public function test_user_factory_defaults_to_least_privileged_role_and_states_work(): void
    {
        $defaultFactoryUser = User::factory()->make();
        $this->assertEquals(User::ROLE_CS, $defaultFactoryUser->role);
        $this->assertFalse($defaultFactoryUser->isSuperAdmin());

        $superAdminUser = User::factory()->superAdmin()->make();
        $this->assertEquals(User::ROLE_SUPER_ADMIN, $superAdminUser->role);
        $this->assertTrue($superAdminUser->isSuperAdmin());

        $editorUser = User::factory()->editor()->make();
        $this->assertEquals(User::ROLE_EDITOR, $editorUser->role);
        $this->assertTrue($editorUser->canManageContent());

        $hrUser = User::factory()->hr()->make();
        $this->assertEquals(User::ROLE_HR, $hrUser->role);
        $this->assertTrue($hrUser->canManageCareers());

        $csUser = User::factory()->cs()->make();
        $this->assertEquals(User::ROLE_CS, $csUser->role);
        $this->assertTrue($csUser->canManageInquiries());
    }

    public function test_missing_empty_null_or_unrecognized_roles_are_denied_administrative_access(): void
    {
        $unrecognizedUser = User::create([
            'name' => 'Random Role',
            'email' => 'random@kubumanagementbali.com',
            'role' => 'unrecognized_visitor',
            'password' => Hash::make('Secret123!'),
        ]);

        // Accessing super_admin route (/admin/users) -> 403
        $this->actingAs($unrecognizedUser)->get('/admin/users')->assertStatus(403);

        // Accessing company profile (/admin/company) -> 403
        $this->actingAs($unrecognizedUser)->get('/admin/company')->assertStatus(403);

        // Accessing content editor route (/admin/services) -> 403
        $this->actingAs($unrecognizedUser)->get('/admin/services')->assertStatus(403);

        // Accessing HR route (/admin/careers) -> 403
        $this->actingAs($unrecognizedUser)->get('/admin/careers')->assertStatus(403);

        // Accessing CS route (/admin/inquiries) -> 403
        $this->actingAs($unrecognizedUser)->get('/admin/inquiries')->assertStatus(403);
    }

    public function test_valid_super_admin_role_still_works_across_all_modules(): void
    {
        $this->actingAs($this->superAdmin)->get('/admin/dashboard')->assertStatus(200);
        $this->actingAs($this->superAdmin)->get('/admin/users')->assertStatus(200);
        $this->actingAs($this->superAdmin)->get('/admin/company')->assertStatus(200);
        $this->actingAs($this->superAdmin)->get('/admin/contact')->assertStatus(200);
        $this->actingAs($this->superAdmin)->get('/admin/services')->assertStatus(200);
        $this->actingAs($this->superAdmin)->get('/admin/projects')->assertStatus(200);
        $this->actingAs($this->superAdmin)->get('/admin/gallery')->assertStatus(200);
        $this->actingAs($this->superAdmin)->get('/admin/careers')->assertStatus(200);
        $this->actingAs($this->superAdmin)->get('/admin/inquiries')->assertStatus(200);
    }

    public function test_editor_hr_and_cs_retain_only_their_intended_module_permissions(): void
    {
        $editor = User::factory()->editor()->create(['email' => 'editor.test@kubumanagementbali.com']);
        $hr = User::factory()->hr()->create(['email' => 'hr.test@kubumanagementbali.com']);
        $cs = User::factory()->cs()->create(['email' => 'cs.test@kubumanagementbali.com']);

        // Editor permissions
        $this->actingAs($editor)->get('/admin/services')->assertStatus(200);
        $this->actingAs($editor)->get('/admin/projects')->assertStatus(200);
        $this->actingAs($editor)->get('/admin/gallery')->assertStatus(200);
        $this->actingAs($editor)->get('/admin/users')->assertStatus(403);
        $this->actingAs($editor)->get('/admin/company')->assertStatus(403);
        $this->actingAs($editor)->get('/admin/careers')->assertStatus(403);
        $this->actingAs($editor)->get('/admin/inquiries')->assertStatus(403);

        // HR permissions
        $this->actingAs($hr)->get('/admin/careers')->assertStatus(200);
        $this->actingAs($hr)->get('/admin/users')->assertStatus(403);
        $this->actingAs($hr)->get('/admin/company')->assertStatus(403);
        $this->actingAs($hr)->get('/admin/services')->assertStatus(403);
        $this->actingAs($hr)->get('/admin/projects')->assertStatus(403);
        $this->actingAs($hr)->get('/admin/inquiries')->assertStatus(403);

        // CS permissions
        $this->actingAs($cs)->get('/admin/inquiries')->assertStatus(200);
        $this->actingAs($cs)->get('/admin/users')->assertStatus(403);
        $this->actingAs($cs)->get('/admin/company')->assertStatus(403);
        $this->actingAs($cs)->get('/admin/services')->assertStatus(403);
        $this->actingAs($cs)->get('/admin/projects')->assertStatus(403);
        $this->actingAs($cs)->get('/admin/careers')->assertStatus(403);
    }

    public function test_partially_selected_user_model_cannot_bypass_check_role_authorization(): void
    {
        // Query user selecting only id, name, email (role column NOT hydrated)
        $partiallyHydratedUser = User::select('id', 'name', 'email')->where('id', $this->superAdmin->id)->first();

        $this->assertNotNull($partiallyHydratedUser);
        $this->assertNull($partiallyHydratedUser->role);
        $this->assertFalse($partiallyHydratedUser->isSuperAdmin(), 'Unhydrated role must never pass isSuperAdmin check.');

        // When acting as this user, CheckRole must reject access because role is null and isSuperAdmin is false
        $response = $this->actingAs($partiallyHydratedUser)->get('/admin/users');
        $response->assertStatus(403);
    }
}
