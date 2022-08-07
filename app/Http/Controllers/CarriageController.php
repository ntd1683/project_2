<?php

namespace App\Http\Controllers;

use App\Enums\CarriageCategoryEnum;
use App\Enums\SeatTypeEnum;
use App\Models\Carriage;
use App\Http\Requests\StoreCarriageRequest;
use App\Http\Requests\UpdateCarriageRequest;
use App\Models\City;
use App\Models\Route as ModelsRoute;
use App\Models\Route_driver_car;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class CarriageController extends Controller
{
    use ResponseTrait;
    private object $model;
    private string $table;

    public function __construct()
    {
        $this->model = (new Carriage())->query();
        $this->table = (new Carriage())->getTable();

        // Làm sidebar - để biết mình đag ở tab nào
        $current_path = Route::getFacadeRoot()->current()->uri();
        $current_path_1 = Str::after($current_path, 'admin/');
        $route = Str::before($current_path_1, '/');

        // Load seat type enum
        $seatTypes = SeatTypeEnum::getArrayView();
        // Load category enum
        $categories = CarriageCategoryEnum::getArrayView();

        View::share([
            'title' => ucwords($this->table),
            'route' => $route,
            'seatTypes' => $seatTypes,
            'categories' => $categories,
        ]);
    }

    public function api()
    {
        $data = $this->model;
        // ->join('route_driver_cars', 'route_driver_cars.car_id', '=', 'carriages.id')
        // ->join('routes', 'routes.id', '=', 'route_driver_cars.route_id')
        // ->join('users', 'users.id', '=', 'route_driver_cars.driver_id')
        // ->select('carriages.id', 'routes.name as route_name', 'routes.id as route_id', 'carriages.license_plate', 'carriages.seat_type', 'carriages.category', 'users.name as driver_name', 'carriages.default_number_seat')
        // ->distinct()
        // ->get();
        return DataTables::of($data)
            ->editColumn('seat_type', function ($model) {
                return SeatTypeEnum::getKeyByValue($model->seat_type);
            })
            ->editColumn('category', function ($model) {
                return CarriageCategoryEnum::getKeyByValue($model->category);
            })
            ->addColumn('edit', function ($object) {
                return route('admin.carriages.edit', $object);
            })
            ->addColumn('delete', function ($object) {
                return route('admin.carriages.destroy', $object);
            })
            ->make(true);
    }

    public function apiNameCarriages(Request $request)
    {
        $route_id = $request->get('route_id');
        return $this->model
            ->select('carriages.id', 'carriages.license_plate')
            ->where('license_plate', 'like', '%' . $request->get('q') . '%')
            ->join('route_driver_cars', 'route_driver_cars.car_id', '=', 'carriages.id')
            ->where('route_driver_cars.route_id', $route_id)
            ->groupBy('carriages.id')
            ->get();
    }

    public function apiNumberSeats(Request $request)
    {

        return $this->model->where('default_number_seat', 'like', '%' . $request->get('q') . '%')->distinct()->orderBy('default_number_seat', 'desc')->get('default_number_seat');
    }

    public function apiGetCarriagesByRoute(Request $request)
    {
        $route_id = $request->get('route_id');
        return $this->model
            ->select('carriages.id', 'carriages.license_plate')
            ->join('route_driver_cars', 'route_driver_cars.car_id', '=', 'carriages.id')
            ->where('route_driver_cars.route_id', $route_id)
            ->groupBy('carriages.id')
            ->get();
    }

    public function index()
    {
        $breadcumbs = Breadcrumbs::render('carriage');
        return view('admin.carriage.index', [
            'breadcumbs' => $breadcumbs,
        ]);
    }

    public function create()
    {
        $breadcumbs = Breadcrumbs::render('carriage.create');
        return view('admin.carriage.create', [
            'breadcumbs' => $breadcumbs,
        ]);
    }

    public function store(StoreCarriageRequest $request)
    {
        try {
            // create carriage
            $license_plate = $request->get('license_plate');
            $category = $request->get('category');
            $seat_type = $request->get('seat_type');
            $default_number_seat = $request->get('default_number_seat');
            // create route_driver_car
            $from = $request->get('from');
            $to = $request->get('to');
            $route1_id = ModelsRoute::query()->where('city_start_id', $from)->where('city_end_id', $to)->first()->id;
            $route2_id = ModelsRoute::query()->where('city_start_id', $to)->where('city_end_id', $from)->first()->id;
            $driver_id = $request->get('driver');
            $price = $request->get('price');

            $this->model->create([
                'license_plate' => $license_plate,
                'category' => $category,
                'seat_type' => $seat_type,
                'default_number_seat' => $default_number_seat,
            ]);

            $carriage_id = $this->model->where('license_plate', $license_plate)->first()->id;
            try {
                Route_driver_car::create([
                    'route_id' => $route1_id,
                    'driver_id' => $driver_id,
                    'car_id' => $carriage_id,
                    'price' => $price,
                ]);
                Route_driver_car::create([
                    'route_id' => $route2_id,
                    'driver_id' => $driver_id,
                    'car_id' => $carriage_id,
                    'price' => $price,
                ]);
            } catch (\Exception $e) {
                // hard delete carriage
                DB::table('carriages')->where('id', $carriage_id)->delete();
                return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
            }
            return redirect()->route('admin.' . $this->table . '.index')->with('success', 'Thêm mới thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Thêm mới thất bại');
        }
    }

    public function edit(Carriage $carriage)
    {
        $RDC = Route_driver_car::query()->where('car_id', $carriage->id)->first();
        $route = ModelsRoute::query()->where('id', $RDC->route_id)->first();
        $cityStart = City::query()->where('id', $route['city_start_id'])->first();
        $cityEnd = City::query()->where('id', $route['city_end_id'])->first();
        $driver = User::query()->where('id', $RDC['driver_id'])->first();
        $breadcumbs = Breadcrumbs::render('carriage.edit', $carriage);
        return view('admin.carriage.edit', [
            'carriage' => $carriage,
            'RDC' => $RDC,
            'route' => $route,
            'from' => $cityStart,
            'to' => $cityEnd,
            'driver' => $driver,
            'breadcumbs' => $breadcumbs,
        ]);
    }


    public function update(UpdateCarriageRequest $request, Carriage $carriage)
    {
        try {
            // update carriage
            $license_plate = $request->get('license_plate');
            $category = $request->get('category');
            $seat_type = $request->get('seat_type');
            $default_number_seat = $request->get('default_number_seat');
            $carriage->update([
                'license_plate' => $license_plate,
                'category' => $category,
                'seat_type' => $seat_type,
                'default_number_seat' => $default_number_seat,
            ]);

            // update route_driver_car
            $from = $request->get('from');
            $to = $request->get('to');
            $route1_id = ModelsRoute::query()->where('city_start_id', $from)->where('city_end_id', $to)->first()->id;
            $route2_id = ModelsRoute::query()->where('city_start_id', $to)->where('city_end_id', $from)->first()->id;
            $driver_id = $request->get('driver');
            $price = $request->get('price');
            $carriage_id = $carriage->id;
            $RDC = Route_driver_car::where('car_id', $carriage_id)->get();
            $RDC[0]->update([
                'route_id' => $route1_id,
                'driver_id' => $driver_id,
                'price' => $price,
            ]);
            $RDC[1]->update([
                'route_id' => $route2_id,
                'driver_id' => $driver_id,
                'price' => $price,
            ]);

            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật thất bại');
        }
    }

    public function destroy($carriage)
    {
        try {
            Carriage::destroy($carriage);
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
