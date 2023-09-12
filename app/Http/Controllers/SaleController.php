<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Services\SaleService;
use App\Models\Seller;
use App\Http\Requests\SaleStoreRequest;

class SaleController extends Controller
{
    public function store(SaleStoreRequest $request){
        return SaleService::store($request->validated());
    }

    public function show(int $id){
        return SaleService::show($id);
    }
}
