<?php

namespace App\Http\Controllers;

use App\Models\Freight_ticket;
use App\Http\Requests\StoreFreight_ticketRequest;
use App\Http\Requests\UpdateFreight_ticketRequest;

class FreightTicketController extends Controller
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
     * @param  \App\Http\Requests\StoreFreight_ticketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFreight_ticketRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Freight_ticket  $freight_ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Freight_ticket $freight_ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Freight_ticket  $freight_ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Freight_ticket $freight_ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFreight_ticketRequest  $request
     * @param  \App\Models\Freight_ticket  $freight_ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFreight_ticketRequest $request, Freight_ticket $freight_ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Freight_ticket  $freight_ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Freight_ticket $freight_ticket)
    {
        //
    }
}
