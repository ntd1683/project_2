<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Buses extends Model
{
    use HasFactory;

    public function route_driver_car()
    {
        return $this->belongsTo(Route_driver_car::class, 'route_driver_car_id');
    }

    public function get_first_day_of_week($number_of_week, $year)
    {
        Date::setWeekStartsAt(Carbon::SUNDAY);
        Date::setWeekEndsAt(Carbon::SATURDAY);
        $day = Carbon::createFromDate($year, 1, 1)->addWeeks($number_of_week-1)->startOfWeek();
        return $day;
    }

    public function get_last_day_of_week($number_of_week, $year)
    {
        Date::setWeekStartsAt(Carbon::SUNDAY);
        Date::setWeekEndsAt(Carbon::SATURDAY);
        $day = Carbon::createFromDate($year, 1, 1)->addWeeks($number_of_week-1)->endOfWeek();
        return $day;
    }

    public function check_time ($departure_time){
        // check today // kiểm tra thời gian so với hôm nay
        $today = Carbon::now();
        $datetime = Carbon::parse($departure_time);
        if($datetime < $today){
            return false;
        }
        return true;
    }

    public function check_travel_time($route_id, $car_id, $departure_time, $buses_id){
        $time = Route::query()->find($route_id)->time;

        $timeMin = Carbon::parse($departure_time)->subHours($time)->format('Y-m-d H:i:s');
        $timeMax = Carbon::parse($departure_time)->addHours($time)->format('Y-m-d H:i:s');

        // check travel time // kiểm tra thời gian di chuyển
        $check_time = Buses::query()
            ->join('route_driver_cars', 'route_driver_cars.id', '=', 'buses.route_driver_car_id')
            ->where('route_driver_cars.car_id', $car_id)
            ->when($buses_id != null, function ($query) use ($buses_id){
                return $query->where('buses.id','!=',$buses_id);
            })
            ->whereBetween('departure_time', [$timeMin, $timeMax]) 
            ->exists();
        if($check_time){
            return false; 
        }
        return true;
    }
    
    // Check if the bus is available in the given time range
    public function check_available_carriage($route_id, $car_id, $departure_time, $buses_id){

        // check carriage reverse route // kiểm tra xe đang ở tuyến đường nào 
        // Nếu xe không hoạt động 1 ngày thì xe đó available
        $departure_time = Carbon::parse($departure_time);
        $nearest_smaller_date = Buses::query()
            ->selectRaw('max(departure_time) as departure_time')
            ->join('route_driver_cars', 'route_driver_cars.id', '=', 'buses.route_driver_car_id')
            ->where('route_driver_cars.car_id', $car_id)
            ->where('departure_time', '<', $departure_time->format('Y-m-d H:i:s'));
        $nearest_bigger_date = Buses::query()
            ->selectRaw('max(departure_time) as departure_time')
            ->join('route_driver_cars', 'route_driver_cars.id', '=', 'buses.route_driver_car_id')
            ->where('route_driver_cars.car_id', $car_id)
            ->where('departure_time', '>', $departure_time->format('Y-m-d H:i:s'));
        $route_id_nearest_date = Buses::query()
        ->join('route_driver_cars', 'route_driver_cars.id', '=', 'buses.route_driver_car_id')
        ->when($buses_id != null, function ($query) use ($buses_id){
            return $query->where('buses.id','!=',$buses_id);
        })
        ->where('route_driver_cars.car_id', $car_id)
        ->where(function ($q) use ($nearest_smaller_date, $nearest_bigger_date){
            $q->orWhere('departure_time', $nearest_smaller_date->first()->departure_time);
            $q->orWhere('departure_time', $nearest_bigger_date->first()->departure_time);
        })
        // Thêm điều kiện 1 ngày không hoạt động
        ->whereBetween('departure_time', [$departure_time->copy()->subDay()->format('Y-m-d H:i:s'), $departure_time->copy()->addDay()->format('Y-m-d H:i:s')])
        ->get()->pluck('route_id')->toArray();
        if(in_array($route_id, $route_id_nearest_date)){
            return false;
        }
        return true;
    }

    // check location carriage befor 1 day
    public function check_location_carriage($routeFrom, $routeTo, $car, $departure_time){
        $departure_time = Carbon::parse($departure_time);

        $nearest_time = Buses::query()
        ->selectRaw('max(departure_time) as departure_time')        
        ->join('route_driver_cars', 'route_driver_cars.id', '=', 'buses.route_driver_car_id')
        ->where('route_driver_cars.car_id',$car)
        ->whereBetween('departure_time',[$departure_time->copy()->subDay()->format('Y-m-d H:i:s'), $departure_time->copy()->format('Y-m-d H:i:s')])
        ->first();

        if ($nearest_time->departure_time == null){
            return 0;
        }

        $route_id_nearest = Buses::query()
        ->where('departure_time',$nearest_time->departure_time)
        ->join('route_driver_cars', 'route_driver_cars.id', '=', 'buses.route_driver_car_id')
        ->where('route_driver_cars.car_id',$car)
        ->first();

        if ($route_id_nearest->route_id == $routeFrom){
            return 1;
        } 
        if ($route_id_nearest->route_id == $routeTo){
            return 2;
        } 
        return 0;
    }

    // create buses for 1 route by schedules
    public function createBusesForOneRoute($dayStart, $dayEnd, $routeId) {
        $countWeek = 0;
        // get route inverse
        $route = Route::find($routeId)->first();
        $routeInverse = Route::query()
            ->where('city_start_id', $route->city_end_id)
            ->where('city_end_id', $route->city_start_id)
            ->first()->id;

        // create array schedule with 2 route 
        // với mảng có key từ 0 - 6, mỗi key có time_of_day tăng dần
        $arraySchedule = [];
        for ($i = 0; $i < 7; $i++){
            $arr = Schedule::query()
                ->select('schedules.id as id', 'schedules.time_of_day as time_of_day', 'schedules.day_of_week as day_of_week',
                            'route_driver_cars.route_id as route_id', 
                            'route_driver_cars.car_id as car_id', 
                            'route_driver_cars.price as price',
                            'route_driver_cars.id as route_driver_car_id')
                ->join('route_driver_cars', 'route_driver_cars.id', '=', 'schedules.route_driver_car_id')
                ->where('schedules.day_of_week', $i)
                ->where(function ($q) use ($routeId, $routeInverse){
                    $q->orWhere('route_driver_cars.route_id', $routeId);
                    $q->orWhere('route_driver_cars.route_id', $routeInverse);
                })
                ->orderBy('time_of_day', 'ASC')
                ->get()->toArray();
            array_push($arraySchedule, $arr);
        }
        // return $arraySchedule;
        // loop with $dayStart and $dayEnd
        // tạo chuyến xe trong vòng lặp // có kiểm tra điều kiện
        for($k = Carbon::parse($dayStart); $k <= Carbon::parse($dayEnd); $k->addDay()){
            //get day of week
            $dayOfWeek = Carbon::parse($k)->dayOfWeek;

            // count week
            if($dayOfWeek == 0){
                $countWeek += 1;
            }

            //set day of week when have pin_double_week
            if ($route->pin_double_week == 1 &&  $countWeek % 2 == 0){
                $dayOfWeek += 1;
                if($dayOfWeek == 7){
                    $dayOfWeek = 0;
                }
            }

            foreach($arraySchedule[$dayOfWeek] as $item){
                $departure_time = (new DateTime($k->format('Y-m-d') . ' ' . Carbon::parse($item['time_of_day'])->format('H:i')))->format('Y-m-d H:i:s');
                $check_travle_time = Buses::check_travel_time($item['route_id'], $item['car_id'], $departure_time, null);
                $available = Buses::check_available_carriage($item['route_id'],  $item['car_id'], $departure_time, null);
                if (!$available || !$check_travle_time) {
                    continue;
                }
                try {
                    $buses = buses::create([
                        'route_driver_car_id' => $item['route_driver_car_id'],
                        'departure_time' => $departure_time,
                        'price' => $item['price'],
                    ])->id;
                } catch (\Exception $e) {
                    continue;
                }
            }
        }
        return [$routeId['id'], $routeInverse];
    }

    // auto create buses for all route with schedule
    public function autoCreateBuses(){
        // get first sunday of next month
        $sundayNextMonth = Carbon::now()->addMonth()->firstOfMonth(0)->format('Y-m-d');
        $saturdayNextTwoMonth = Carbon::now()->addMonths(2)->firstOfMonth(6)->format('Y-m-d');
        $routeIdArray = Route::query()->select('Routes.id as id')->orderBy('Routes.id','ASC')->get()->toArray();
        $createdRouteArray = [];
        foreach ($routeIdArray as $routeId){
            if (in_array($routeId['id'], $createdRouteArray)){
                continue;
            }
            $creatingRouteId = Buses::createBusesForOneRoute($sundayNextMonth, $saturdayNextTwoMonth, $routeId);
            $createdRouteArray = array_merge($createdRouteArray, $creatingRouteId);
        }
    }

    //create buses for all route with schedule and time start time end
    public function createBusesAllRouteWithTime($dayStart, $dayEnd){
        $routeIdArray = Route::query()->select('Routes.id as id')->orderBy('Routes.id','ASC')->get()->toArray();
        $createdRouteArray = [];
        foreach ($routeIdArray as $routeId){
            if (in_array($routeId['id'], $createdRouteArray)){
                continue;
            }
            $creatingRouteId = Buses::createBusesForOneRoute($dayStart, $dayEnd, $routeId);
            $createdRouteArray = array_merge($createdRouteArray, $creatingRouteId);
        }
    }

    public $timestamps = false;

    protected $fillable = [
        "route_driver_car_id",
        "departure_time",
        "price",
    ];

    // Auto delete related row
    public static function boot() {
        parent::boot();

        static::deleting(function($buses) {
                $buses->billDetails()->get()->each->delete();
        });
    }

    public function billDetails()
    {
        return $this->hasMany(Bill_detail::class);
    }
}
