<?php

namespace App\Http\Controllers;

use App\Enums\CarriageCategoryEnum;
use App\Enums\SeatTypeEnum;
use App\Models\Route;
use App\Models\Route_driver_car;
use App\Http\Requests\StoreRoute_driver_carRequest;
use App\Http\Requests\UpdateRoute_driver_carRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class RouteDriverCarController extends Controller
{

    use ResponseTrait;
    private object $model;
    private string $table;

    public function __construct(){
        $this->model = (new Route_driver_car())->query();
        $this->table = (New Route_driver_car())->getTable();
        // Làm sidebar - để biết mình đag ở tab nào
        $current_path = \Illuminate\Support\Facades\Route::getFacadeRoot()->current()->uri();
        $current_path_1 = Str::after($current_path, 'admin/');
        $route = Str::before($current_path_1, '/');
        View::share([
            'title'=> ucwords($this->table),
            'route'=> $route,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function api($request)
    {
//        dd($request);
        $arr = $this->model->with('driver_name')->with('car_name')
            ->where('route_id',$request)
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
        return DataTables::of($arr)
            ->editColumn('name_driver', function ($object) {
                return $object->name_driver;
            })
            ->editColumn('license_plate_car', function ($object) {
                return $object->license_plate_car;
            })
            ->editColumn('category_car', function ($object) {
                return $object->category_car;
            })
            ->editColumn('seat_type_car', function ($object) {
                return $object->seat_type_car;
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoute_driver_carRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoute_driver_carRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Route_driver_car  $route_driver_car
     * @return \Illuminate\Http\Response
     */
    public function show(Route_driver_car $route_driver_car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Route_driver_car  $route_driver_car
     * @return \Illuminate\Http\Response
     */
    public function edit(Route_driver_car $route_driver_car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoute_driver_carRequest  $request
     * @param  \App\Models\Route_driver_car  $route_driver_car
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoute_driver_carRequest $request, Route_driver_car $route_driver_car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Route_driver_car  $route_driver_car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Route_driver_car $route_driver_car)
    {
        //
    }
}
