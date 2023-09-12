<?php

namespace App\Services;


use App\Models\Seller;
use App\Repositories\SellerRepository;

class SellerService{

    public static function getSellersWithTotalComissions()
    {
        try{
            $sellers = Seller::with('sales')->get()->map(function ($seller) {
                $seller->total_commission = $seller->calculateTotalComission();
                return $seller;
            });
            
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

    public static function create($data){
        return SellerRepository::create($data);
    }

    public static function show( int $id){
        $seller = Seller::findOrFail($id);

        return response()->json($seller, 200);
    }

    public static function update($data, $int){
        return SellerRepository::update($data, $int);
    }

    public static function destroy($int){
        return SellerRepository::destroy($int);
    }
    
    public static function getSellersWithSalesToday()
    {
        $today = now('America/Sao_Paulo')->format('Y-m-d');

        $sellers = Seller::whereHas('sales', function ($query) use ($today) {
            $query->whereDate('created_at', $today);
        })->with(['sales' => function ($query) use ($today) {
            $query->whereDate('created_at', $today);
        }])->get();
    
        foreach ($sellers as $seller) {
            $totalSales = $seller->sales->sum('amount');
            $totalComission = $seller->sales->sum('comission');
    
            $seller->total_sales_today = $totalSales;
            $seller->total_commission_today = $totalComission;
        }

        return $sellers;
    }
}