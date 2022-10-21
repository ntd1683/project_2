<?php

namespace App\Http\Controllers;

use App\Enums\CarriageCategoryEnum;
use App\Enums\CarriageColorEnum;
use App\Enums\SeatTypeEnum;
use App\Http\Requests\StoreScheduleRequest;
use App\Models\Route_driver_car;
use App\Models\Schedule;
use Carbon\Carbon;
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
            ->select('schedules.id as id', 'schedules.day_of_week as day_of_week', 'schedules.time_of_day as time_of_day',
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
        $route_id = $request['route_id'];
        // $convert string to array json
        $array = json_decode($str, TRUE);

                
        // Delete all records that are not in array
        try {
            $this->model
                ->join('route_driver_cars', 'route_driver_cars.id', '=', 'schedules.route_driver_car_id')
                ->where('route_driver_cars.route_id', $route_id)
                ->whereNotIn('schedules.id', array_column($array, 'id'))->delete();
        } catch(\Exception $e) {
            return $this->errorResponse("Lưu thất bại");
        }
        // Create or update schedules
        try {
            foreach($array as $value){
                $RDC_id = Route_driver_car::query()->where('route_id', $route_id)->where('car_id', $value['car_id'])->first()->id;
                if($value['id'] == 0){
                    $this->model->create([
                        'route_driver_car_id' => $RDC_id,
                        'day_of_week' => $value['day_of_week'],
                        'time_of_day' => $value['time_of_day'],
                    ]);
                } else {
                    $this->model->where('schedules.id', $value['id'])
                    ->update([
                        'route_driver_car_id' => $RDC_id,
                        'day_of_week' => $value['day_of_week'],
                        'time_of_day' => $value['time_of_day'],
                    ]);
                }
            }
        } catch(\Exception $e) {
            return $this->errorResponse("Lưu thất bại");
        }

        return $this->successResponse([],"Lưu thành công");
    }
}
