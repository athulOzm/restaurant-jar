<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function prevent_indexing_dashboard_without_credential()
    {
        $response = $this->get('/');
        $response->assertStatus(302);
    }

    /** @test */
    public function admin_can_index_dashboard()
    {
        $user = factory(User::class)->create([
            'email' =>  'admin@restoapp.com'
        ]);

        $response = $this->actingAs($user)
                         ->get('/');

        $response->assertStatus(200);
    }

    
}
