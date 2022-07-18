<?php

namespace App\Http\Controllers;

use App\Models\Buses;
use App\Http\Requests\StoreBusesRequest;
use App\Http\Requests\UpdateBusesRequest;
use App\Models\Route as ModelsRoute;
use App\Models\Route_driver_car;
use DateTime;
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
            ->select('buses.id', 'routes.name as route_name', 'routes.id as route_id', 'buses.departure_time', 'routes.time', 'routes.distance', 'route_driver_cars.price', 'carriages.license_plate', 'users.name as driver_name')
            ->get();
        return DataTables::of($data)
            ->addColumn('date', function ($object) {
                // get date from departure_time
                $date = date('d/m/Y', strtotime($object->departure_time));
                return $date;
            })
            ->addColumn('edit', function ($object) {
                return route('admin.carriages.edit', $object);
            })
            ->addColumn('delete', function ($object) {
                return route('admin.carriages.destroy', $object);
            })
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.' . $this->table . '.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.' . $this->table . '.create');
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
            $start_city_id = $request->get('to');
            $end_city_id = $request->get('from');
            $driver = $request->get('driver');
            $car = $request->get('car');

            // get departure_time
            $date = $request->get('date');
            $time = $request->get('time');

            // get price
            $price = $request->get('price');

            // create new buses
            $departure_time = new DateTime($date . ' ' . $time);
            $route = ModelsRoute::query()->where('city_start_id', $start_city_id)->where('city_end_id', $end_city_id)->first()->id;
            $route_driver_car_id = Route_driver_car::query()->where('route_id', $route)->where('driver_id', $driver)->where('car_id', $car)->first()->id;
            if ($route_driver_car_id == null) {
                return $this->responseError('Không tìm thấy tuyến đường này');
            }
            $this->model->create([
                'route_driver_car_id' => $route_driver_car_id,
                'departure_time' => $departure_time,
                'price' => $price,
            ]);

            // return view index
            return redirect()->route('admin.' . $this->table . '.index')->with('success', 'Thêm mới thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.' . $this->table . '.create')->with('error', 'Thêm mới thất bại');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buses  $buses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buses $buses)
    {
        //
    }
}
