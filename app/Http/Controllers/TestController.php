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
        $this->model = (new Route())->query();
        $this->table = (new Route())->getTable();
    }

    public function test()
    {
//        $test = Bill_detail::query()
//            ->selectRaw("routes.name,COUNT('id') as count")
//            ->leftJoin('buses', 'bill_details.buses_id', '=', 'buses.id')
//            ->leftJoin('route_driver_cars', 'buses.route_driver_car_id', '=', 'route_driver_cars.id')
//            ->leftJoin('routes', 'route_driver_cars.route_id', '=', 'routes.id')
//            ->groupBy('routes.name')
//            ->orderBy('count','desc')
//            ->get();
//        dd($test);
//        $mytime = date('d/m/y');
//        dd($mytime);
        $route_model = $this->model->with('city_start')->with('city_end')
            ->get()
            ->map(function($each){
                $arr_route_driver_car = Route_driver_car::query()->with('car_name')
                    ->select('car_id','route_id')
                    ->where('route_id',$each->id)
                    ->get()
                    ->map(function ($each1){
                        $each1->category_car = CarriageCategoryEnum::getKeyByValue(($each1->car_name->pluck('category'))[0]);
                        $each1->seat_type_car = SeatTypeEnum::getKeyByValue(($each1->car_name->pluck('seat_type'))[0]);
                        unset($each1->driver_name,$each1->car_name);
                        return $each1;
                    })->toArray();
                $arr_category_car = [];
                $arr_seat_type_car = [];
                foreach ($arr_route_driver_car as $key => $value){
                    $arr_category_car[$key]= $value['category_car'];
                    $arr_seat_type_car[$key]= $value['seat_type_car'];
                }
                $arr_category_car = array_unique($arr_category_car);
                $each->category_car = implode(', ', $arr_category_car);
                $arr_seat_type_car = array_unique($arr_seat_type_car);
                $each->seat_type_car = implode(', ', $arr_seat_type_car);
                return $each;
            });
        dd($route_model);
    }
}
