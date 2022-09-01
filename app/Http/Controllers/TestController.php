<?php

namespace App\Http\Controllers;

use App\Enums\CarriageCategoryEnum;
use App\Enums\SeatTypeEnum;
use App\Models\Bill;
use App\Models\Bill_detail;
use App\Models\Buses;
use App\Models\Carriage;
use App\Models\City;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Route;
use App\Models\Route_driver_car;
use Illuminate\Support\Facades\Crypt;
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
        $this->model = (new Route())->query();
        $this->table = (new Route())->getTable();
    }

    public function test()
    {
        $test = '+84-53-163-3317';
        return view('test',[
            'test'=>$test,
        ]);
    }

    public function get_test(Request $request){
        dd($request);
    }
}
