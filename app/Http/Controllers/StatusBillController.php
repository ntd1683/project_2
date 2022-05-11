<?php

namespace App\Http\Controllers;

use App\Models\Status_bill;
use App\Http\Requests\StoreStatus_billRequest;
use App\Http\Requests\UpdateStatus_billRequest;

class StatusBillController extends Controller
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
     * @param  \App\Http\Requests\StoreStatus_billRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStatus_billRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Status_bill  $status_bill
     * @return \Illuminate\Http\Response
     */
    public function show(Status_bill $status_bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Status_bill  $status_bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Status_bill $status_bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStatus_billRequest  $request
     * @param  \App\Models\Status_bill  $status_bill
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStatus_billRequest $request, Status_bill $status_bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Status_bill  $status_bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status_bill $status_bill)
    {
        //
    }
}
