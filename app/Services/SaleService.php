<?php

namespace App\Services;

use App\Models\Sale;
use App\Repositories\SaleRepository;

class SaleService{

    public static function store($data){
        return SaleRepository::store($data);
    }

    public static function show($id){
        $sales = Sale::where('seller_id', $id)->get();

        if($sales->count() !== 0){
            return response()->json($sales, 200);
        }

        return response()->json(['error' => 'Vendedor não encontrado'], 404);
    }
    
}