<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'amount',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($sale) {
            $seller = Seller::find($sale->seller_id);

            if ($seller) {
                $sale->name = $seller->name;
                $sale->email = $seller->email;

                // Calcular a comissão (8.5% de amount)
                $comission = $sale->amount * 0.085;
                $sale->comission = $comission;
            }
        });
    }
}
