<?php

namespace App\Http\Controllers;

use App\Events\UserCreateEvent;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\City;
use App\Models\Location;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Throwable;

class LocationController extends Controller
{
    use ResponseTrait;
    private object $model;
    private string $table;

    public function __construct()
    {
        $this->model = (new Location())->query();
        $this->table = (new Location())->getTable();
        // Làm sidebar - để biết mình đag ở tab nào
        $current_path = Route::getFacadeRoot()->current()->uri();
        $current_path_1 = Str::after($current_path, 'admin/');
        $route = Str::before($current_path_1, '/');
        View::share([
            'route' => $route,
        ]);
    }

    public function index()
    {
        $breadcumbs = Breadcrumbs::render('locations');
        return view('admin.location.index', [
            'breadcumbs' => $breadcumbs,
        ]);
    }

    public function api()
    {
        $location_model = $this->model->with('city');
        return DataTables::of($location_model)
            ->editColumn('name', function ($object) {
                return $object->name ?: '';
            })
            ->editColumn('city', function ($object) {
                return $object->city->name;
            })
            ->addColumn('destroy', function ($object) {
                return route('admin.locations.destroy', $object);
            })
            ->addColumn('edit', function ($object) {
                return route('admin.locations.edit', $object);
            })
            ->filterColumn('city', function ($query, $keyword) {
                if ($keyword !== 'null') {
                    $query->where('city_id', $keyword);
                }
            })
            ->make(true);
    }

    public function apiName(Request $request)
    {
        return $this->model->where('name', 'like', '%' . $request->get('q') . '%')->get();
    }

    public function apiAddress(Request $request)
    {
        return $this->model->where('address', 'like', '%' . $request->get('q') . '%')->get();
    }

    public function apiDistrict(Request $request)
    {
        return $this->model->where('district', 'like', '%' . $request->get('q') . '%')->get();
    }

    public function create()
    {
        $breadcumbs = Breadcrumbs::render('create_location');
        return view('admin.location.create', [
            'breadcumbs' => $breadcumbs,
        ]);
    }

    public function store(StoreLocationRequest $request)
    {
        $city_name = City::where('name', $request->get('city'))->firstOrFail();
        $city_id = $city_name->id;
        $name = $request->get('name') ?: null;
//        dd($request);
        try {
            $arr = $request->only([
                "address",
                "district",
            ]);
            $arr['name'] = $name;
            $arr['city_id'] = $city_id;
//            dd($arr);
            $this->model->create($arr);
            return redirect()->route('admin.locations.index')->with('success', 'Bạn thêm thành công !!!');
        } catch (Throwable $e) {
            return redirect()->route('admin.locations.create')->with('error', 'Bạn thêm thất bại rồi, vui lòng thử lại sau !!!');
        }
    }

    public function edit(Location $location)
    {
        $city_name = City::where('id', $location->city_id)->firstOrFail()->name;
        $breadcumbs = Breadcrumbs::render('edit_location', $location);
        return view('admin.location.edit', [
            'city_name' => $city_name,
            'location' => $location,
            'breadcumbs' => $breadcumbs,
        ]);
    }

    public function update(UpdateLocationRequest $request, $location)
    {
        $city_name = City::where('name', $request->get('city'))->firstOrFail();
        $city_id = $city_name->id;
        $name = $request->get('name') ?: null;
//        dd($request);
        try {
            $arr = $request->only([
                "address",
                "district",
            ]);
            $arr['name'] = $name;
            $arr['city_id'] = $city_id;
//            dd($arr);
            $object = $this->model->find($location);
            $object -> fill($arr);
            $object->save();
            return redirect()->route('admin.locations.index')->with('success', 'Bạn sửa thành công !!!');
        } catch (Throwable $e) {
            return redirect()->route('admin.locations.create')->with('error', 'Bạn sửa thất bại rồi, vui lòng thử lại sau !!!');
        }
    }

    public function destroy($location)
    {
        $arr = [];
        $arr['status'] = true;
        $arr['messages'] = '';
        Location::destroy($location);
        return response($arr, 200);
    }
}
