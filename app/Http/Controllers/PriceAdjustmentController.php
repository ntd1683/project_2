<?php

namespace App\Http\Controllers;

use App\Models\Price_adjustment;
use App\Http\Requests\StorePrice_adjustmentRequest;
use App\Http\Requests\UpdatePrice_adjustmentRequest;

class PriceAdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePrice_adjustmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrice_adjustmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Price_adjustment  $price_adjustment
     * @return \Illuminate\Http\Response
     */
    public function show(Price_adjustment $price_adjustment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Price_adjustment  $price_adjustment
     * @return \Illuminate\Http\Response
     */
    public function edit(Price_adjustment $price_adjustment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePrice_adjustmentRequest  $request
     * @param  \App\Models\Price_adjustment  $price_adjustment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrice_adjustmentRequest $request, Price_adjustment $price_adjustment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Price_adjustment  $price_adjustment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Price_adjustment $price_adjustment)
    {
        //
    }
}
