<?php

namespace App\Http\Controllers;

use App\Enums\CarriageCategoryEnum;
use App\Enums\SeatTypeEnum;
use App\Models\Carriage;
use App\Http\Requests\StoreCarriageRequest;
use App\Http\Requests\UpdateCarriageRequest;
use App\Http\Requests\UpdateRoute_driver_carRequest;
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
use SebastianBergmann\CodeCoverage\Driver\Driver;
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
        $q = $request->get('q');
        $query = $this->model
            ->select('carriages.id', 'carriages.license_plate')
            ->where('license_plate', 'like', '%' . $q . '%');
        $query->when($route_id != null, function ($query) use ($route_id) 
        {
            return $query->join('route_driver_cars', 'route_driver_cars.car_id', '=', 'carriages.id')
            ->where('route_driver_cars.route_id', $route_id)
            ->groupBy('carriages.id');
        });
        return $query->get();
    }

    public function apiNumberSeats(Request $request)
    {
        return $this->model->where('default_number_seat', 'like', '%' . $request->get('q') . '%')->distinct()->orderBy('default_number_seat', 'desc')->get('default_number_seat');
    }

    public function apiCarriageByID(Request $request){
        $id = $request->get('car_id');
        $result = $this->model
                ->join('route_driver_cars', 'route_driver_cars.car_id', '=', 'carriages.id')
                ->join('users', 'route_driver_cars.driver_id', '=', 'users.id')
                ->where('carriages.id', $id)
                ->first();
        return $result;
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
            $license_plate = $request->get('license_plate');
            $category = $request->get('category');
            $seat_type = $request->get('seat_type');
            $default_number_seat = $request->get('default_number_seat');
            $route1_id = $request->get('route_from');
            $route2_id = $request->get('route_to');
            $driver_id = $request->get('driver');
            $price = $request->get('price');

            $carriage_id=$this->model->create([
                'license_plate' => $license_plate,
                'category' => $category,
                'seat_type' => $seat_type,
                'default_number_seat' => $default_number_seat,
            ])->id;

            // create route_driver_car with 2 route
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
                $this->model->withTrashed()->where('id', $carriage_id)->forceDelete();
                return ['success' => false, 'message' => 'Liên kết tuyến đường bị lỗi'];
            }
            return ['id' => $carriage_id, 'success' => true, 'message' => 'Thêm xe thành công'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Thêm xe thất bại'];
        }
    }

    public function edit(Carriage $carriage)
    {
        $RDC = Route_driver_car::query()->where('car_id', $carriage->id)->FirstOrFail();
        $route = ModelsRoute::query()->where('id', $RDC->route_id)->FirstOrFail();
        $routeReverse = ModelsRoute::query()->where('city_start_id', $route['city_end_id'])->where('city_end_id', $route['city_start_id'])->FirstOrFail();
        $driver = User::query()->where('id', $RDC['driver_id'])->FirstOrFail();
        $breadcumbs = Breadcrumbs::render('carriage.edit', $carriage);
        return view('admin.carriage.edit', [
            'carriage' => $carriage,
            'RDC' => $RDC,
            'route' => $route,
            'routeReverse' => $routeReverse,
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
            return ['success' => true, 'message' => 'Cập nhật xe thành công'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Cập nhật xe thất bại'];
        }
    }

    public function updateCarAndRDC(UpdateCarriageRequest $request, Carriage $carriage)
    {
        try {
            // update carriage
            $license_plate = $request->get('license_plate');
            $category = $request->get('category');
            $seat_type = $request->get('seat_type');
            $default_number_seat = $request->get('default_number_seat');
            $route1_id = $request->get('route_from');
            $route2_id = $request->get('route_to');
            $driver_id = $request->get('driver');
            $price = $request->get('price');
            $carriage->update([
                'license_plate' => $license_plate,
                'category' => $category,
                'seat_type' => $seat_type,
                'default_number_seat' => $default_number_seat,
            ]);
            $RDC1 = Route_driver_car::updateOrCreate([
                'route_id' => $route1_id,
                'car_id' => $carriage->id,
            ],[
                'driver_id' => $driver_id,
                'price' => $price,
            ]);
            $RDC2 = Route_driver_car::updateOrCreate([
                'route_id' => $route2_id,
                'car_id' => $carriage->id,
            ],[
                'driver_id' => $driver_id,
                'price' => $price,
            ]);
            return ['success' => true, 'message' => 'Cập nhật thành công'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Cập nhật thất bại'];
        }
    }

    public function updateRDC(UpdateRoute_driver_carRequest $request, Carriage $carriage)
    {
        try {
            // update route_driver_car
            $route1_id = $request->get('route_from');
            $route2_id = $request->get('route_to');
            $driver_id = $request->get('driver');
            $price = $request->get('price');
            $carriage_id = $carriage->id;
            $RDC = Route_driver_car::where('car_id', $carriage_id)->get();
            $RDC[0]->update([
                'route_id' => $route1_id,
                'driver_id' => $driver_id,
                'car_id' => $carriage_id,
                'price' => $price,
            ]);
            $RDC[1]->update([
                'route_id' => $route2_id,
                'driver_id' => $driver_id,
                'car_id' => $carriage_id,
                'price' => $price,
            ]);

            return ['success' => true, 'message' => 'Cập nhật liên kết thành công'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Cập nhật liên kết thất bại'];
        }
    }

    public function destroy($carriage)
    {
        try {
            Carriage::destroy($carriage);
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
