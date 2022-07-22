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
            ->select('buses.id', 'routes.name as route_name', 'routes.id as route_id', 'buses.departure_time', 'routes.time', 'routes.distance', 'buses.price', 'carriages.license_plate', 'users.name as driver_name')
            ->get();
        return DataTables::of($data)
            ->addColumn('date', function ($object) {
                // get date from departure_time
                $date = date('d/m/Y', strtotime($object->departure_time));
                return $date;
            })
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
        $driver_id = $request->get('driver_id');
        return DB::table('route_driver_cars')
            ->where('route_id', $route_id)
            ->where('car_id', $car_id)
            ->where('driver_id', $driver_id)
            ->select('price')
            ->first();
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
            $driver = $request->get('driver');
            $car = $request->get('car');

            // get departure_time
            $date = $request->get('date');
            $time = $request->get('time');

            // get price
            $price = $request->get('price');

            // create new buses
            $departure_time = new DateTime($date . ' ' . $time);
            $route_driver_car_id = Route_driver_car::query()->where('route_id', $route)->where('driver_id', $driver)->where('car_id', $car)->first()->id;
            $this->model->create([
                'route_driver_car_id' => $route_driver_car_id,
                'departure_time' => $departure_time,
                'price' => $price,
            ]);

            // return view index
            return redirect()->route('admin.' . $this->table . '.index')->with('success', 'Thêm mới thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Thêm mới thất bại');
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
        $cityStart = City::query()->where('id', $route['city_start_id'])->first();
        $cityEnd = City::query()->where('id', $route['city_end_id'])->first();
        $driver = User::query()->where('id', $RDC['driver_id'])->first();
        $car = Carriage::query()->where('id', $RDC['car_id'])->first();
        $breadcumbs = Breadcrumbs::render('buses.edit', $buses);
        return view('admin.' . $this->table . '.edit', [
            'buses' => $buses,
            'route' => $route,
            'from' => $cityStart,
            'to' => $cityEnd,
            'driver' => $driver,
            'car' => $car,
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
            $driver = $request->get('driver');
            $car = $request->get('car');

            // get departure_time
            $date = $request->get('date');
            $time = $request->get('time');
            // get price
            $price = $request->get('price');
            // update buses
            $departure_time = new DateTime($date . ' ' . $time);
            $route_driver_car_id = Route_driver_car::query()->where('route_id', $route)->where('driver_id', $driver)->where('car_id', $car)->first()->id;
            $buses->update([
                'route_driver_car_id' => $route_driver_car_id,
                'departure_time' => $departure_time,
                'price' => $price,
            ]);
            // return view index
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật thất bại');
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
                'heading' => 'success',
                'text' => 'Xóa thành công',
                'icon' => 'success',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'heading' => 'error',
                'text' => 'Xóa thất bại',
                'icon' => 'error',
            ]);
        }
    }
}
