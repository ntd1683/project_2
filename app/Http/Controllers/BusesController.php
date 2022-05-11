<?php

namespace App\Http\Controllers;

use App\Models\Buses;
use App\Http\Requests\StoreBusesRequest;
use App\Http\Requests\UpdateBusesRequest;

class BusesController extends Controller
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
     * @param  \App\Http\Requests\StoreBusesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBusesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buses  $buses
     * @return \Illuminate\Http\Response
     */
    public function show(Buses $buses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buses  $buses
     * @return \Illuminate\Http\Response
     */
    public function edit(Buses $buses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBusesRequest  $request
     * @param  \App\Models\Buses  $buses
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBusesRequest $request, Buses $buses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buses  $buses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buses $buses)
    {
        //
    }
}
