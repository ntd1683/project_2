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
        $city_start = 28;
        $city_end = 24;
        $departure_time = '10-10-2022';
        $departure_time = date("Y-m-d", strtotime($departure_time));
        $route_id = Route::query()->where('city_start_id',$city_start)->where('city_end_id',$city_end)->pluck('id')[0];
        $route_driver_cars = Route_driver_car::query()->with('driver_name','car_name','route')
            ->where('route_id',$route_id)
            ->get()
            ->map(function ($each) use ($departure_time) {
                $each->name_driver = ($each->driver_name->pluck('name'))[0];
                $each->license_plate_car = ($each->car_name->pluck('license_plate'))[0];
                $each->category_car = CarriageCategoryEnum::getKeyByValue(($each->car_name->pluck('category'))[0]);
                $each->seat_type_car = SeatTypeEnum::getKeyByValue(($each->car_name->pluck('seat_type'))[0]);
                $each->departure_time = Buses::query()->where('route_driver_car_id',$each->id)
                    ->where('status',1)
//                    ->whereDate('departure_time','=',$departure_time)
                    ->pluck('departure_time');
                unset($each->driver_name);
                unset($each->car_name);
                if(!$each->departure_time->isEmpty()) {
                    return $each;
                }
            });
        $i =0;
        foreach($route_driver_cars as $each){
            if($each != null){
                $arr[$i++] = $each;
            }
        }
        return $arr;
    }
}
