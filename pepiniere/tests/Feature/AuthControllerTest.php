<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_utilisateur_enregistré()
    {
        $response = $this->postJson('/api/register', [
            'nom' => 'John Doe',
            'email' => 'hounaida@gmail.com',
            'password' => 'password123',
            'role' => 'admin',
        ]);
     
        $response->assertStatus(201) 
                 ->assertJsonStructure(['status', 'message', 'token']); 
    
        $this->assertDatabaseHas('users', ['email' => 'hounaida@gmail.com']); 
    }
      
        
        public function test_registration_fails_if_email_is_not_unique()
        {
            User::create([
                'nom' => 'Jane Doe',
                'email' => 'hounaida@gmail.com',
                'password' => bcrypt('password123'),
                'role' => 'admin',  
            ]);
            
            $response = $this->postJson('/api/register', [
                'nom' => 'John Doe',
                'email' => 'hounaida@gmail.com',
                'password' => 'password123',
                'role' => 'admin', 
            ]);
            
            $response->assertStatus(422) 
                    ->assertJsonValidationErrors(['email']); 
        }




}
