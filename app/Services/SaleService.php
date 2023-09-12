<?php

namespace App\Services;

use App\Models\Sale;
use App\Models\Seller;
use App\Repositories\SaleRepository;

class SaleService{

    public static function store($data){
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
            
            return SaleRepository::store($sale);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro interno ao cadastrar a venda'], 500);
        }
    }

    public static function show($id){
        $sales = Sale::where('seller_id', $id)->get();

        if($sales->count() !== 0){
            return response()->json($sales, 200);
        }

        return response()->json(['error' => 'Vendedor não encontrado'], 404);
    }
    
}