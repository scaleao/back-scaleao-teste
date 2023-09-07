<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Seller;
use App\Http\Requests\SaleStoreRequest;

class SaleController extends Controller
{
    public function store(SaleStoreRequest $request){
        try{
            $sale = Sale::create($request->all());
            if($sale){
                return response()->json($sale, 200);
            }
        } catch (\Exception $e) {
            return response()->json(['erro' => 'Ocorreu um erro interno ao cadastrar venda'], 500);
        }
    }

    public function show(int $id){
        $seller = Seller::findOrFail($id);
        $sales = $seller->sale;

        return response()->json($sales, 200);
    }
}
