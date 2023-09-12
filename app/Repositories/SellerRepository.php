<?php

namespace App\Repositories;

use App\Models\Seller;

class SellerRepository{

    public static function create($data){
        try{
            $seller = Seller::create($data);
            if($seller){
                return response()->json($seller, 200);
            }
        } catch (\Exception $e) {
            return response()->json(['erro' => 'Ocorreu um erro interno ao cadastrar vendedor'], 500);
        }
    }

    public static function update($data, $int){
        try{
            $seller = Seller::findOrFail($int);
            $seller->update($data);
            if($seller){
                return response()->json($seller, 200);
            }
        } catch (\Exception $e) {
            return response()->json(['erro' => 'Ocorreu um erro interno ao atualizar vendedor'], 500);
        }
    }

    public static function destroy($id){
        try{
            $seller = Seller::findOrFail($id);
            $seller->delete($id);

            if($seller){
                return response()->json('Vendedor deletado com sucesso', 200);
            }
        } catch (\Exception $e) {
            return response()->json(['erro' => 'Ocorreu um erro interno ao deletar vendedor'], 500);
        }
    }
}