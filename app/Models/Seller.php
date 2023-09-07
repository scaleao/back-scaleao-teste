<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
    ];

    public function sale()
    {
        return $this->hasMany(Sale::class);
    }
}
