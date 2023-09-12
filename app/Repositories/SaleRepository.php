<?php

namespace App\Repositories;

use App\Models\Sale;

class SaleRepository{

    public static function store(Sale $sale)
    {
        try {
            if ($sale->save()) {
                return response()->json($sale, 200);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro interno ao cadastrar a venda'], 500);
        }
    }
    
}