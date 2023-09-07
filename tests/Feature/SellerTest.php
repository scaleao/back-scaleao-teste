<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Seller;

class SellerTest extends TestCase
{
    
    use RefreshDatabase;
    
    public function test_seller_index(): void
    {
        Seller::factory(5)->create();

        $response = $this->getJson('/vendedores');
 
        $response->assertStatus(200);
    }

    public function test_seller_store(): void
    {
        $response = $this->postJson('/vendedores/', [
                "name" => "Scaleao",
                "email" => "teste@teste.com"
            ]);
 
        $response->assertStatus(200)
            ->assertJsonFragment([
                "name" => "Scaleao",
                "email" => "teste@teste.com"
            ]);
    }

    public function test_seller_show(): void
    {
        $seller = Seller::factory()->create();
 
        $response = $this->getJson('/vendedores/'. $seller->id);

        $response->assertStatus(200)
            ->assertJsonFragment([
                "id" => $seller->id,
                "name" => $seller->name,
                "email" => $seller->email
            ]);
    }
    
    public function test_seller_delete(): void
    {
        $seller = Seller::factory()->create();
 
        $response = $this->deleteJson('/vendedores/'. $seller->id);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'Vendedor deletado com sucesso'
            ]);
    }
}
