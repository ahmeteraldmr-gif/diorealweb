<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test unauthenticated access to /admin redirects to /login.
     */
    public function test_unauthenticated_user_cannot_access_admin_and_redirects_to_login(): void
    {
        $response = $this->get('/admin');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * Test login with invalid credentials fails.
     */
    public function test_user_cannot_login_with_invalid_credentials(): void
    {
        $response = $this->post('/login', [
            'username' => 'wronguser@dioreal.com',
            'password' => 'wrongpass',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('login_error');
        $this->assertFalse(session()->has('is_admin'));
    }

    /**
     * Test login with environment variables fallback works.
     */
    public function test_user_can_login_with_env_credentials(): void
    {
        $response = $this->post('/login', [
            'username' => 'admin',
            'password' => 'admin',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/admin');
        $this->assertTrue(session()->get('is_admin'));
    }

    /**
     * Test login with database user credentials works.
     */
    public function test_user_can_login_with_database_credentials(): void
    {
        $user = User::create([
            'name' => 'Test Admin',
            'email' => 'admin@dioreal.com',
            'password' => Hash::make('password123'),
            'role' => 'super_admin',
            'permissions' => ['hotels', 'users'],
        ]);

        $response = $this->post('/login', [
            'username' => 'admin@dioreal.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/admin');
        $this->assertTrue(session()->get('is_admin'));
        $this->assertTrue(auth()->check());
        $this->assertEquals($user->id, auth()->id());
    }

    /**
     * Test super admin can access any panel.
     */
    public function test_super_admin_can_access_all_panels(): void
    {
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'super@dioreal.com',
            'password' => Hash::make('password123'),
            'role' => 'super_admin',
            'permissions' => ['hotels', 'restaurants', 'yachts', 'users'],
        ]);

        $response = $this->actingAs($superAdmin)
                         ->withSession(['is_admin' => true])
                         ->get('/admin');

        $response->assertStatus(200);

        // Can access hotels management
        $response = $this->actingAs($superAdmin)
                         ->withSession(['is_admin' => true])
                         ->get('/admin/hotels');
        $response->assertStatus(200);

        // Can access users management
        $response = $this->actingAs($superAdmin)
                         ->withSession(['is_admin' => true])
                         ->get('/admin/users');
        $response->assertStatus(200);
    }

    /**
     * Test restricted editor permissions.
     */
    public function test_restricted_editor_is_blocked_from_unauthorized_panels(): void
    {
        $editor = User::create([
            'name' => 'Hotel Editor',
            'email' => 'editor@dioreal.com',
            'password' => Hash::make('password123'),
            'role' => 'editor',
            'permissions' => ['hotels'], // ONLY has hotels permission
        ]);

        // Editor can access hotel index page
        $response = $this->actingAs($editor)
                         ->withSession(['is_admin' => true])
                         ->get('/admin/hotels');
        $response->assertStatus(200);

        // Editor is BLOCKED from restaurant index page
        $response = $this->actingAs($editor)
                         ->withSession(['is_admin' => true])
                         ->get('/admin/restaurants');
        $response->assertStatus(302);
        $response->assertRedirect('/admin');
        $response->assertSessionHasErrors('permission_error');

        // Editor is BLOCKED from user management
        $response = $this->actingAs($editor)
                         ->withSession(['is_admin' => true])
                         ->get('/admin/users');
        $response->assertStatus(302);
        $response->assertRedirect('/admin');
    }

    /**
     * Test user management CRUD operations (Only Super Admin can access).
     */
    public function test_super_admin_can_manage_users(): void
    {
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'super@dioreal.com',
            'password' => Hash::make('password123'),
            'role' => 'super_admin',
            'permissions' => ['users'],
        ]);

        // 1. Create User
        $response = $this->actingAs($superAdmin)
                         ->withSession(['is_admin' => true])
                         ->post('/admin/users', [
                             'name' => 'New Editor',
                             'email' => 'neweditor@dioreal.com',
                             'password' => 'editor123',
                             'role' => 'editor',
                             'permissions' => ['hotels', 'restaurants']
                         ]);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/users');

        $this->assertDatabaseHas('users', [
            'email' => 'neweditor@dioreal.com',
            'role' => 'editor'
        ]);

        $newUser = User::where('email', 'neweditor@dioreal.com')->first();
        $this->assertTrue($newUser->hasPermission('hotels'));
        $this->assertTrue($newUser->hasPermission('restaurants'));
        $this->assertFalse($newUser->hasPermission('users'));

        // 2. Update User
        $response = $this->actingAs($superAdmin)
                         ->withSession(['is_admin' => true])
                         ->put('/admin/users/' . $newUser->id, [
                             'name' => 'Updated Editor',
                             'email' => 'neweditor@dioreal.com',
                             'role' => 'editor',
                             'permissions' => ['yachts'] // change permission to yachts only
                         ]);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/users');

        $newUser->refresh();
        $this->assertEquals('Updated Editor', $newUser->name);
        $this->assertTrue($newUser->hasPermission('yachts'));
        $this->assertFalse($newUser->hasPermission('hotels'));

        // 3. Delete User
        $response = $this->actingAs($superAdmin)
                         ->withSession(['is_admin' => true])
                         ->delete('/admin/users/' . $newUser->id);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/users');
        $this->assertDatabaseMissing('users', [
            'id' => $newUser->id
        ]);
    }
}
