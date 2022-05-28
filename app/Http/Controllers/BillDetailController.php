<?php

namespace App\Http\Controllers;

use App\Models\Bill_detail;
use App\Http\Requests\StoreBill_detailRequest;
use App\Http\Requests\UpdateBill_detailRequest;

class BillDetailController extends Controller
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
     * @param  \App\Http\Requests\StoreBill_detailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBill_detailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bill_detail  $bill_detail
     * @return \Illuminate\Http\Response
     */
    public function show(Bill_detail $bill_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bill_detail  $bill_detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill_detail $bill_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBill_detailRequest  $request
     * @param  \App\Models\Bill_detail  $bill_detail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBill_detailRequest $request, Bill_detail $bill_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bill_detail  $bill_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill_detail $bill_detail)
    {
        //
    }
}
