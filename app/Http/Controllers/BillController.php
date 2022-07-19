<?php

namespace App\Http\Controllers;

use App\Enums\UserLevelEnum;
use App\Models\Bill;
use App\Http\Requests\StoreBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->model = (new Bill())->query();
        $this->table = (New Bill())->getTable();
    }

    public function index()
    {
        //
    }

    public function apiCustomerRevenue(){

        $customer_revenue = $this->model->with('customer_name')
            ->selectRaw("customer_id")
            ->selectRaw("SUM(price) as revenue")
            ->groupBy('customer_id')
            ->orderBy('revenue','desc')
            ->limit(30)
            ->get()
            ->map(function ($each){
                $each->name_customer = $each->customer_name->name;
                $each->gender_customer = ($each->customer_name->gender == 1) ? 'nam' : 'nữ';
                $each->birthdate_customer = date('d-m-Y', strtotime($each->customer_name->birthdate));
                unset($each->customer_name);
                return $each;
            });

        return DataTables::of($customer_revenue)->make(true);
    }

    public function apiRevenue(Request $request)
    {
        $arr = [];
        $data = $request->data;
        if($data == 1){
            $price = Bill::query()
                ->selectRaw("DATE_FORMAT(created_at,'%d-%m-%Y') as date")
                ->selectRaw("SUM(price) as revenue")
                ->groupBy('date')
                ->orderBy('date', 'desc')
                ->where('created_at', '>', now()->subDays(30)->endOfDay())
                ->get()->toArray();
            foreach ($price as $each){
                $arr[$each['date']] = (float)$each['revenue'];
            }
        }
        else if($data == 2){
            $price = Bill::query()
                ->selectRaw("DATE_FORMAT(created_at,'%m-%Y') as date")
                ->selectRaw("SUM(price) as revenue")
                ->groupBy('date')
                ->orderBy('date', 'desc')
                ->where('created_at', '>', now()->subMonths(12)->endOfMonth())
                ->get()->toArray();
            foreach ($price as $each){
                $arr[$each['date']] = (float)$each['revenue'];
            }
        }
        return $arr;
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
     * @param  \App\Http\Requests\StoreBillRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBillRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBillRequest  $request
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBillRequest $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        //
    }
}
