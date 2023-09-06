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
        $sellers = Seller::all();
        return $sellers->count() ? $sellers : null;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SellerStoreOurUpdateResquest $request)
    {
        $vendedor = Seller::create($request->validated());
        return $vendedor ? $vendedor : false;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $seller = Seller::findOrFail($id);

        return $seller;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SellerStoreOurUpdateResquest $request, $id)
    {
        $seller = Seller::findOrFail($id);
        $seller->update($request->validated());

        return $seller;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->delete($id);

        return $seller ? true : false;
    }
}
