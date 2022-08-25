<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuickDestroyBusesRequest;
use App\Http\Requests\QuickStoreBusesRequest;
use App\Models\Buses;
use App\Http\Requests\StoreBusesRequest;
use App\Http\Requests\UpdateBusesRequest;
use App\Models\Carriage;
use App\Models\City;
use App\Models\Route as ModelsRoute;
use App\Models\Route_driver_car;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class BusesController extends Controller
{
    use ResponseTrait;
    private object $model;
    private string $table;

    public function __construct()
    {
        $this->model = (new Buses())->query();
        $this->table = (new Buses())->getTable();

        // Làm sidebar - để biết mình đag ở tab nào
        $current_path = Route::getFacadeRoot()->current()->uri();
        $current_path_1 = Str::after($current_path, 'admin/');
        $route = Str::before($current_path_1, '/');

        View::share([
            'title' => ucwords($this->table),
            'route' => $route,
        ]);
    }

    public function api()
    {
        $data = $this->model->join('route_driver_cars', 'route_driver_cars.id', '=', 'buses.route_driver_car_id')
            ->join('routes', 'routes.id', '=', 'route_driver_cars.route_id')
            ->join('carriages', 'carriages.id', '=', 'route_driver_cars.car_id')
            ->join('users', 'users.id', '=', 'route_driver_cars.driver_id')
            ->select('buses.id', 'routes.name as route_name', 'routes.id as route_id','routes.images as images', 'buses.departure_time', 'routes.time', 'routes.distance', 'buses.price', 'carriages.license_plate', 'users.name as driver_name')
            ->get();
        return DataTables::of($data)
            ->addColumn('edit', function ($object) {
                return route('admin.buses.edit', $object);
            })
            ->addColumn('delete', function ($object) {
                return route('admin.buses.destroy', $object);
            })
            ->make(true);
    }

    public function apiGetPrice(Request $request)
    {
        $route_id = $request->get('route_id');
        $car_id = $request->get('car_id');
        return Route_driver_car::query()
            ->where('route_id', $route_id)
            ->where('car_id', $car_id)
            ->select('price')
            ->first();
    }

    public function apiGetDay(Request $request)
    {
        $year = $request->get('year');
        $week = '';
        if ($request->get('week_start') != null) {
            $week = $request->get('week_start');
            $date = (new Buses())->get_first_day_of_week($week, $year);
            return $date->format('d/m/Y');
        } else {
            $week = $request->get('week_end');
            $date = (new Buses())->get_last_day_of_week($week, $year);
            return $date->format('d/m/Y');
        }
        return false;
    }

    public function apiCheckCarriage(Request $request){
        $all = $request->all();
        $routeFrom = $request->get('route_from');
        $routeTo = $request->get('route_to');
        $year = $request->get('year');
        $week = $request->get('week');

        // get date
        $date = (new Buses())->get_first_day_of_week($week, $year)->format('Y-m-d H:i:s');

        try{
            $listCar = Carriage::select('carriages.id', 'carriages.license_plate')
                ->join('route_driver_cars', 'route_driver_cars.car_id', '=', 'carriages.id')
                ->where('route_driver_cars.route_id', $routeFrom)
                ->groupBy('carriages.id')
                ->get();
        }  catch (\Exception $e) {
            return $this->errorResponse("Kiểm tra xe thất bại");
        }

        $array_carriage_type = [];

        foreach ($listCar as $car){
            $check =(new Buses())->check_location_carriage($routeFrom, $routeTo, $car->id, $date);
            if($check==1){
                $array_carriage_type["$car->id"] = [1,$car->license_plate];
            }else if($check==2){
                $array_carriage_type["$car->id"] = [2,$car->license_plate];
            } else {
                $array_carriage_type["$car->id"] = [0,$car->license_plate];
            }
        }

        return $this->successResponse($array_carriage_type, "Kiểm tra thành công");
    }

    public function apiCalendar(Request $request)
    {
        $route_id = $request->get('route_id');
        return $this->model
            ->select('buses.id as id', 'buses.departure_time as departure_time', 'buses.price as price',
                    'carriages.license_plate as license_plate', 'carriages.id as car_id',
                    'users.name as driver_name',
                    'route_driver_cars.route_id as route_id')
            ->join('route_driver_cars', 'route_driver_cars.id', '=', 'buses.route_driver_car_id')
            ->join('carriages', 'carriages.id', '=', 'route_driver_cars.car_id')
            ->join('users', 'users.id', '=', 'route_driver_cars.driver_id')
            ->where('route_driver_cars.route_id', $route_id)
            ->get();
    }

    public function calendar()
    {
        return view('admin.buses.calendar');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcumbs = Breadcrumbs::render('buses');
        return view('admin.' . $this->table . '.index', [
            'breadcumbs' => $breadcumbs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcumbs = Breadcrumbs::render('buses.create');
        return view('admin.' . $this->table . '.create', [
            'breadcumbs' => $breadcumbs,
        ]);
    }

    public function quickCreate()
    {
        return view('admin.' . $this->table . '.quick_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBusesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBusesRequest $request)
    {
        try {
            // get route_driver_car
            $route = $request->get('route');
            $car = $request->get('car');

            // get departure_time
            $date = $request->get('date');
            $time = $request->get('time');
            $departure_time = new DateTime($date . ' ' . $time);

            // get price
            $price = $request->get('price');

            // check available
            $available = (new Buses())->check_available_carriage($route, $car, $departure_time);
            if (!$available) {
                return $this->errorResponse("Xe đang bận");
            }

            // create new buses
            $route_driver_car_id = Route_driver_car::query()->where('route_id', $route)->where('car_id', $car)->first()->id;
            $buses = $this->model->create([
                'route_driver_car_id' => $route_driver_car_id,
                'departure_time' => $departure_time,
                'price' => $price,
            ])->id;

            // return success
            return [
                'success' => true,
                'message' => 'Tạo mới thành công',
                'id' => $buses,
            ];
        } catch (\Exception $e) {
            return $this->errorResponse("Tạo mới thất bại");
        }
    }

    public function quickStore(QuickStoreBusesRequest $request)
    {
        $routeFrom = $request->get('route_from');
        $routeTo = $request->get('route_to');
        $time_move = $request->get('time_move');
        $distance = $request->get('distance');
        $carriageFree = $request->get('carriage_free');
        $carriageFrom = $request->get('carriage_from');
        $carriageTo = $request->get('carriage_to');
        $year = $request->get('year');
        $weekStart = $request->get('week_start');
        $weekEnd = $request->get('week_end');
        $timeTwoBuses = Carbon::parse($request->get('time_two_buses'));
        $timeStartDay = Carbon::parse($request->get('time_start_day'));
        $timeEndDay = Carbon::parse($request->get('time_end_day'));

        //convert time to int (minutes)
        //->format('His.u') Compare times without date 
        //$timeTwoBuses->hour get hour
        //$timeTwoBuses->minute get minute

        // get date start and end
        $dateStart = (new Buses())->get_first_day_of_week($weekStart, $year);
        $dateEnd = (new Buses())->get_last_day_of_week($weekEnd, $year);

        // create array of carriages
        $carriageFromArray = array_merge($carriageFrom,$carriageTo); // array_merge gộp mảng
        $carriageToArray = array_merge($carriageTo,$carriageFrom);
        $j = 0;

        for($k = $dateStart; $k <= $dateEnd; $k->addDay()){
            $i = $timeStartDay->copy();
            for($i; $i <= $timeEndDay; $i->addHours($timeTwoBuses->hour)->addMinutes($timeTwoBuses->minute)){
                $departure_time = (new DateTime($k->format('Y-m-d') . ' ' . $i->format('H:i')))->format('Y-m-d H:i:s');
                $available = (new Buses())->check_available_carriage($routeFrom, $carriageFromArray[$j], $departure_time);
                if (!$available) {
                    continue;
                }
                $available = (new Buses())->check_available_carriage($routeTo, $carriageToArray[$j], $departure_time);
                if (!$available) {
                    continue;
                }
                try{ 
                    $route_driver_car_from = Route_driver_car::query()->where('route_id', $routeFrom)->where('car_id', $carriageFromArray[$j])->first();
                    $route_driver_car_to = Route_driver_car::query()->where('route_id', $routeTo)->where('car_id', $carriageToArray[$j])->first();
                } catch (\Exception $e) {
                    continue;
                }
                if($j == count($carriageFromArray) - 1){
                    $j = 0;
                }else{
                    $j++;
                }
                try{
                    $buses_from = $this->model->create([
                        'route_driver_car_id' => $route_driver_car_from->id,
                        'departure_time' => $departure_time,
                        'price' => $route_driver_car_from->price,
                    ])->id;
                    $buses_to = $this->model->create([
                        'route_driver_car_id' => $route_driver_car_to->id,
                        'departure_time' => $departure_time,
                        'price' => $route_driver_car_to->price,
                    ])->id;
                } catch (\Exception $e) {
                    continue;
                }
            }
        }
        return $this->successResponse([], "Tạo nhanh thành công");
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buses  $buses
     * @return \Illuminate\Http\Response
     */
    public function show(Buses $buses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buses  $buses
     * @return \Illuminate\Http\Response
     */
    public function edit(Buses $buses)
    {
        $RDC = Route_driver_car::query()->where('id', $buses['route_driver_car_id'])->first();
        $route = ModelsRoute::query()->where('id', $RDC['route_id'])->first();
        $driver = User::query()->where('id', $RDC['driver_id'])->first();
        $carriage = Carriage::query()->where('id', $RDC['car_id'])->first();
        $breadcumbs = Breadcrumbs::render('buses.edit', $buses);
        return view('admin.' . $this->table . '.edit', [
            'buses' => $buses,
            'route' => $route,
            'driver' => $driver,
            'carriage' => $carriage,
            'breadcumbs' => $breadcumbs,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBusesRequest  $request
     * @param  \App\Models\Buses  $buses
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBusesRequest $request, Buses $buses)
    {
        try {
            // get route_driver_car
            $route = $request->get('route');
            $car = $request->get('car');

            // get departure_time
            $date = $request->get('date');
            $time = $request->get('time');
            // get price
            $price = $request->get('price');
            // update buses
            $departure_time = new DateTime($date . ' ' . $time);
            $route_driver_car_id = Route_driver_car::query()->where('route_id', $route)->where('car_id', $car)->first()->id;
            
            $buses->update([
                'route_driver_car_id' => $route_driver_car_id,
                'departure_time' => $departure_time,
                'price' => $price,
            ]);
            // return with success
            return $this->successResponse([],"Cập nhật thành công");
        } catch (\Exception $e) {
            return $this->errorResponse("Cập nhật thất bại");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buses  $buses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buses $buses)
    {
        try {
            $buses->delete();
            return $this->successResponse([],"Xóa thành công");
        } catch (\Exception $e) {
            return $this->errorResponse("Xóa thất bại");
        }
    }

    public function quickDelete(){
        return view('admin.' . $this->table . '.quick_delete');
    }

    public function quickDestroy(QuickDestroyBusesRequest $request){
        $routeFrom = $request->get('route_from');
        $routeTo = $request->get('route_to');
        $year = $request->get('year');
        $weekStart = $request->get('week_start');
        $weekEnd = $request->get('week_end');

        // get date start and end
        $dateStart = Carbon::parse((new Buses())->get_first_day_of_week($weekStart, $year))->format('Y-m-d H:i:s');
        $dateEnd = Carbon::parse((new Buses())->get_last_day_of_week($weekEnd, $year))->format('Y-m-d H:i:s');

        try {
            $deleteBuses= Buses::join('route_driver_cars', 'route_driver_cars.id', '=', 'buses.route_driver_car_id')
            ->where(function ($q) use ($routeFrom, $routeTo){
                $q->orWhere('route_driver_cars.route_id', $routeFrom);
                $q->orWhere('route_driver_cars.route_id', $routeTo);
            })
            ->where('departure_time', '>=', $dateStart)
            ->where('departure_time', '<=', $dateEnd)
            ->delete();
            return $this->successResponse([],"Xóa nhanh thành công");
        } catch (\Exception $e){
            return $this->errorResponse("Xóa nhanh thất bại");
        }
    }
}
