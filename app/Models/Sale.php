<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'amount',
        'name',
        'email',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
