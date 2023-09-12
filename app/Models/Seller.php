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
}
