<?php

namespace App\Http\Controllers;

use App\Enums\CarriageCategoryEnum;
use App\Enums\CarriageColorEnum;
use App\Enums\SeatTypeEnum;
use App\Http\Requests\StoreScheduleRequest;
use App\Models\Schedule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    use ResponseTrait;
    private object $model;
    private string $table;

    public function __construct()
    {
        $this->model = (new Schedule())->query();
        $this->table = (new Schedule())->getTable();

        // Làm sidebar - để biết mình đag ở tab nào
        $current_path = Route::getFacadeRoot()->current()->uri();
        $current_path_1 = Str::after($current_path, 'admin/');
        $route = Str::before($current_path_1, '/');

        View::share([
            'title' => ucwords($this->table),
            'route' => $route,
        ]);
    }

    public function index()
    {
        
        $seatTypes = SeatTypeEnum::getArrayView();
        $categories = CarriageCategoryEnum::getArrayView();
        $color = CarriageColorEnum::getArrayView();
        return view('admin.' . $this->table . '.index',[
            'seatTypes' => $seatTypes,
            'categories' => $categories,
            'color' => $color,
        ]);
    }

    public function apiSchedule(Request $request)
    {
        $route_id = $request->get('route_id');
        return $this->model
            ->select('schedules.id as id', 'schedules.day_of_week as day_of_week', 'schedules.time_of_day as time_of_day', 'schedules.pin_double_week as pin_double_week',
                    'carriages.license_plate as license_plate', 'carriages.id as car_id', 'carriages.color as color',
                    'route_driver_cars.route_id as route_id')
            ->join('route_driver_cars', 'route_driver_cars.id', '=', 'schedules.route_driver_car_id')
            ->join('carriages', 'carriages.id', '=', 'route_driver_cars.car_id')
            ->where('route_driver_cars.route_id', $route_id)
            ->get()
            ->map(function ($each) {
                $each->color = CarriageColorEnum::getKeyByValue($each->color);
                return $each;
            });
    }

    public function store(StoreScheduleRequest $request)
    {
        $str = $request['data'];
        // $array = explode(',', $str);
        $array = json_decode($str, TRUE);
        return $array[0];
    }
}
