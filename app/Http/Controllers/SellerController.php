<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellerStoreOurUpdateResquest;
use App\Services\SellerService;

 class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SellerService::getSellersWithTotalComissions();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SellerStoreOurUpdateResquest $request)
    {
        return SellerService::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return SellerService::show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SellerStoreOurUpdateResquest $request, int $id)
    {
        return SellerService::update($request->validated(), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return SellerService::destroy($id);
    }
}
