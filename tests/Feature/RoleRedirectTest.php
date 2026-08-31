<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RoleRedirectTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Ensure roles exist by running seeders
        $this->seed([\Database\Seeders\AdminSeeder::class, \Database\Seeders\OrganizerSeeder::class]);
    }

    public function test_organizer_login_redirect_and_authorization()
    {
        $organizer = User::where('email', 'organizer@kajiansystem.test')->first() ?? User::where('email', 'organizer@kajianweb.test')->first();
        
        if (!$organizer) {
            $organizer = User::factory()->create(['role' => 'organizer', 'email' => 'organizer@kajiansystem.test']);
        }

        // Test login redirect
        $response = $this->post('/login', [
            'email' => $organizer->email,
            'password' => 'password',
        ]);
        $response->assertRedirect('/organizer');

        // Test access authorized
        $this->actingAs($organizer);
        $response = $this->get('/organizer');
        $response->assertStatus(200);

        // Test access unauthorized
        $response = $this->get('/admin');
        $response->assertStatus(403);
    }

    public function test_admin_login_redirect_and_authorization()
    {
        $admin = User::where('email', 'admin@kajiansystem.test')->first() ?? User::where('email', 'admin@kajianweb.test')->first();
        
        if (!$admin) {
            $admin = User::factory()->create(['role' => 'admin', 'email' => 'admin@kajiansystem.test']);
        }

        // Test login redirect
        $response = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);
        $response->assertRedirect('/admin');

        // Test access authorized
        $this->actingAs($admin);
        $response = $this->get('/admin');
        $response->assertStatus(200);

        // Test access unauthorized
        $response = $this->get('/organizer');
        $response->assertStatus(403);
    }

    public function test_guest_redirect_to_login()
    {
        $response = $this->get('/organizer');
        $response->assertRedirect('/login');

        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }
}
