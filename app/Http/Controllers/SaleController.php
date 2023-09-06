<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Http\Requests\SaleStoreRequest;

class SaleController extends Controller
{
    public function store(SaleStoreRequest $request){
        $sale = Sale::create($request->all());
        return $sale ? $sale : false;
    }
}
