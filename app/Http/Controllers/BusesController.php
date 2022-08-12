<?php

namespace App\Http\Controllers;

use App\Models\Buses;
use App\Http\Requests\StoreBusesRequest;
use App\Http\Requests\UpdateBusesRequest;
use App\Models\Carriage;
use App\Models\City;
use App\Models\Route as ModelsRoute;
use App\Models\Route_driver_car;
use App\Models\User;
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

            // get price
            $price = $request->get('price');

            // create new buses
            $departure_time = new DateTime($date . ' ' . $time);
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
            return [
                'success' => false,
                'message' => 'Tạo mới thất bại',
            ];
        }
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
            return [
                'success' => true,
                'message' => 'Cập nhật thành công',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Cập nhật thất bại',
            ];
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
            return response()->json([
                'success' => true,
                'message' => 'Xóa thành công',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xóa thất bại',
            ]);
        }
    }
}
