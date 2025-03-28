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
      
        
        public function test_registration_si_email_pas_unique()
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
        public function test_utilisateur_connecté()
        {
            $user = User::create([
                'email' => 'hounaida@gmail.com',
                'password' => bcrypt('password123'), 
            ]);

            $response = $this->postJson('/api/login', [
                'email' => 'hounaida@gmail.com',
                'password' => 'password123',
            ]);

            $response->assertStatus(200)
                    ->assertJsonStructure(['status', 'message', 'token']); 

            $token = $response->json('token');

            $response = $this->getJson('/api/user', [
                'Authorization' => 'Bearer ' . $token, 
            ]);

            $response->assertStatus(200)
                    ->assertJson([
                        'email' => 'hounaida@gmail.com', 
                    ]);

            $this->assertDatabaseHas('users', ['email' => 'hounaida@gmail.com']);
        }




}
