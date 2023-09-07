<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Http\Requests\SellerStoreOurUpdateResquest;

 class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $sellers = Seller::getSellersWithTotalComissions();

            if($sellers->count() == 0){
                return response()->json(['message' => 'Vendedores não encontrados'], 404);
            }

            return response()->json($sellers, 200);
        } catch (\Exception $e) {
            return response()->json(
                ['erro' => 'Ocorreu um erro interno consultar todos os vendedores']
                , 500
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SellerStoreOurUpdateResquest $request)
    {
        try{
            $seller = Seller::create($request->validated());
            if($seller){
                return response()->json($seller, 200);
            }
        } catch (\Exception $e) {
            return response()->json(['erro' => 'Ocorreu um erro interno ao cadastrar vendedor'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $seller = Seller::findOrFail($id);

        return response()->json($seller, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SellerStoreOurUpdateResquest $request, int $id)
    {
        try{
            $seller = Seller::findOrFail($id);
            $seller->update($request->validated());
            if($seller){
                return response()->json($seller, 200);
            }
        } catch (\Exception $e) {
            return response()->json(['erro' => 'Ocorreu um erro interno ao atualizar vendedor'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
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
