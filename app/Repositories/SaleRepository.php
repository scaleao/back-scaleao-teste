<?php

namespace App\Repositories;

use App\Models\Sale;
use App\Models\Seller;

class SaleRepository{

    public static function store($data)
    {
        try {
            $sellerId = $data['seller_id'];
            $amount = $data['amount'];

            $seller = Seller::findOrFail($sellerId);

            if (!$seller) {
                return response()->json(['error' => 'Vendedor não encontrado'], 404);
            }

            $commission = $amount * 0.085;

            $sale = new Sale([
                'seller_id' => $sellerId,
                'name' => $seller->name,
                'email' => $seller->email,
                'amount' => $amount,
                'commission' => $commission,
            ]);

            if ($sale->save()) {
                return response()->json($sale, 200);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro interno ao cadastrar a venda'], 500);
        }
    }
    
}