<?php

namespace App\Http\Controllers;

use App\Models\Carriage;
use App\Http\Requests\StoreCarriageRequest;
use App\Http\Requests\UpdateCarriageRequest;

class CarriageController extends Controller
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
     * @param  \App\Http\Requests\StoreCarriageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarriageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carriage  $carriage
     * @return \Illuminate\Http\Response
     */
    public function show(Carriage $carriage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carriage  $carriage
     * @return \Illuminate\Http\Response
     */
    public function edit(Carriage $carriage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarriageRequest  $request
     * @param  \App\Models\Carriage  $carriage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarriageRequest $request, Carriage $carriage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carriage  $carriage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carriage $carriage)
    {
        //
    }
}
