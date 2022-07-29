<?php

namespace App\Http\Controllers;

use App\Enums\CarriageCategoryEnum;
use App\Enums\SeatTypeEnum;
use App\Models\Bill;
use App\Models\Bill_detail;
use App\Models\Buses;
use App\Models\Carriage;
use App\Models\Customer;
use App\Models\Route;
use App\Models\Route_driver_car;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class TestController extends Controller
{
    private object $model;
    private string $table;

    public function __construct()
    {
        $this->model = (new Bill_detail())->query();
        $this->table = (New Bill_detail())->getTable();
    }

    public function test()
    {

    }

    public function apiRevenueTest(Request $request)
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

    public function apiTest()
    {
        return DataTables::of($this->model)
            ->addColumn('edit', function ($model) {
                // return route('admin.carriage.edit', $model->id);
            })
            ->addColumn('delete', function ($model) {
                // return route('admin.carriage.destroy', $model->id);
            })
            ->rawColumns(['edit', 'delete'])
            ->make(true);
    }

    public function test1()
    {

    }
}
