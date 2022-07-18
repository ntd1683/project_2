<?php

namespace App\Http\Controllers;

use App\Enums\CarriageCategoryEnum;
use App\Enums\SeatTypeEnum;
use App\Models\Carriage;
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
        $this->model = (new Route_driver_car())->query();
        $this->table = (New Route_driver_car())->getTable();
    }

    public function test()
    {
        return view('test');
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
        $arr = $this->model->with('driver_name')->with('car_name')
            ->where('route_id',7)
            ->get()
            ->map(function ($each){
                $each->name_driver = ($each->driver_name->pluck('name'))[0];
                $each->license_plate_car = ($each->car_name->pluck('license_plate'))[0];
                $each->category_car = CarriageCategoryEnum::getKeyByValue(($each->car_name->pluck('category'))[0]);
                $each->seat_type_car = SeatTypeEnum::getKeyByValue(($each->car_name->pluck('seat_type'))[0]);
                unset($each->driver_name);
                unset($each->car_name);
                return $each;
            });
        return $arr;
    }
}
