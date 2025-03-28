<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tests\TestCase;

class LogTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_utilisateur_connecté()
    {

        $response = $this->postJson('/api/login', [
            'email' => 'hounaida@gmail.com',
            'password' => 'password123', 
        ]);
    
        $response->assertStatus(200)
                 ->assertJsonStructure(['token', 'user']); 
        $token = $response->json('token');
        $this->assertNotNull($token); 
        $response->assertJsonFragment([
            'user' => [
                'email' => 'hounaida@gmail.com', 
            ]
        ]);
    }
}
