<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Categorie;
use App\Models\User;

use Tests\TestCase;

class ModifyCategorieTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_modifier_categorie_success()
    {
        $user = User::factory()->create();
        $token = auth()->login($user); 
        $categorie = Categorie::create([
            'nom' => 'Categorie Originale',
        ]);

        $response = $this->putJson('/api/modifierCategorie/' . $categorie->id, [
            'nom' => 'Categorie Mise à Jour', 
        ], [
            'Authorization' => 'Bearer ' . $token, 
        ]);
        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Categorie mise à jour avec succès',
                     'categorie' => [
                         'nom' => 'Categorie Mise à Jour', 
                     ]
                 ]);
        $this->assertDatabaseHas('categories', [
            'categories_id' => $categorie->id,
            'nom' => 'Categorie Mise à Jour', 
        ]);
    }
}
