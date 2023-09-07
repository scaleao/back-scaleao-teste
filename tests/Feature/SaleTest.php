<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Seller;
use Illuminate\Support\Facades\Log;

class SaleTest extends TestCase
{
    
    use RefreshDatabase;
    
    public function test_sale_store(): void
    {
        $seller = Seller::factory()->create();
        $amount = 1000;
        $comission = $amount * 0.085;

        $response = $this->postJson('/venda/', [
                "seller_id" => $seller->id,
                "amount" => $amount
            ]);
 
        $response->assertStatus(200)
            ->assertJsonFragment([
                "name" => $seller->name,
                "email" => $seller->email,
                "amount" => $amount,
                "comission" => $comission

            ]);
    }

    public function test_sale_show(): void
    {
        $seller = Seller::factory()->create();
        $amount = 1000;

        $response = $this->postJson('/venda/', [
                "seller_id" => $seller->id,
                "amount" => $amount
            ]);
        
        $response = $this->getJson('/venda/'. $seller->id);

        $response->assertStatus(200);
    }
}
