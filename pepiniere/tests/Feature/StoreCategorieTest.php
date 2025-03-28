<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreCategorieTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store_categorie_success()
{
    $response = $this->postJson('/api/store', [
        'nom' => 'Categorie Test',
    ]);

    $response->assertStatus(201)
             ->assertJson([
                 'status' => true, 
                 'message' => 'categorie Created Successfully',
             ]);
    $this->assertDatabaseHas('categories', [
        'nom' => 'Categorie Test', 
    ]);
}
}
