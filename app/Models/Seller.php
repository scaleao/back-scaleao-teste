<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class, 'seller_id');
    }
    public function calculateTotalComission()
    {
        return $this->sales->sum('comission');
    }

    public static function getSellersWithTotalComissions()
    {
        return self::with('sales')->get()->map(function ($seller) {
            $seller->total_commission = $seller->calculateTotalComission();
            return $seller;
        });
    }

    public static function getSellersWithSalesToday()
    {
        $today = now('America/Sao_Paulo')->format('Y-m-d');

        $sellers = DB::table('sellers')
            ->select('sellers.*')
            ->join('sales', 'sellers.id', '=', 'sales.seller_id')
            ->whereDate('sales.created_at', $today)
            ->distinct()
            ->get();

        foreach ($sellers as $seller) {
            $sales = DB::table('sales')
                ->where('seller_id', $seller->id)
                ->whereDate('created_at', $today)
                ->get();

            $totalSales = 0;
            $totalComission = 0;
            foreach ($sales as $sale) {
                $totalSales += $sale->amount;
                $totalComission += $sale->comission;
            }

            $seller->total_commission_today = $totalComission;
            $seller->total_amount_today = $totalSales;
            $seller->sales = $sales;
        }

        return $sellers;
    }
}
