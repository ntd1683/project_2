<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Route;
use App\Http\Requests\StoreRouteRequest;
use App\Http\Requests\UpdateRouteRequest;
use App\Models\Route_driver_car;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;

use Throwable;

class RouteController extends Controller
{

    use ResponseTrait;
    private object $model;
    private string $table;

    public function __construct(){
        $this->model = (new Route())->query();
        $this->table = (New Route())->getTable();
        // Làm sidebar - để biết mình đag ở tab nào
        $current_path = \Illuminate\Support\Facades\Route::getFacadeRoot()->current()->uri();
        $current_path_1 = Str::after($current_path, 'admin/');
        $route = Str::before($current_path_1, '/');
        View::share([
            'title'=> ucwords($this->table),
            'route'=> $route,
        ]);
    }

    public function index()
    {
//        $route_model = $this->model->with('city_start')->with('city_end')->find('1');
//        $result = $route_model->toArray();
//        dd($result);
        $breadcumbs = Breadcrumbs::render('route');
        return view('admin.route.index',[
            'breadcumbs' =>$breadcumbs,
        ]);
    }

    public function api()
    {
        $route_model = $this->model->with('city_start')->with('city_end');
        return DataTables::of($route_model)
            ->editColumn('city_start', function ($object) {
                return $object->city_start->pluck('name')->toArray();
            })
            ->editColumn('city_end', function ($object) {
                return $object->city_end->pluck('name')->toArray();
            })
            ->editColumn('name', function ($object) {
                return $object->name;
            })
            ->editColumn('distance', function ($object) {
                return $object->distance_name;
            })
            ->editColumn('time', function ($object) {
                return $object->time_name;
            })
            ->addColumn('show', function ($object) {
                return route('admin.routes.show',$object);
            })
            ->addColumn('edit', function ($object) {
                return route('admin.routes.edit',$object);
            })
            ->addColumn('destroy', function ($object) {
                return route('admin.routes.destroy', $object);
            })
            ->filterColumn('name', function($query, $keyword) {
                if($keyword !=='null'){
                    $query->where('name',$keyword);
                }
            })
            ->filterColumn('city_start', function($query, $keyword) {
                if($keyword !=='null'){
                    $query->where('city_start_id',$keyword);
                }
            })
            ->filterColumn('city_end', function($query, $keyword) {
                if($keyword !=='null'){
                    $query->where('city_end_id',$keyword);
                }
            })
            ->make(true);
    }

    public function apiNameRoutes(Request $request)
    {
        return $this->model->where('name','like','%'.$request->get('q') .'%')->get();
    }

    public function apiCityStart(Request $request)
    {
        return City::where('name','like','%'.$request->get('q') .'%')->get();
    }

    public function apiCityEnd(Request $request)
    {
        return City::where('name','like','%'.$request->get('q') .'%')->get();
    }

    public function create()
    {
        $breadcumbs = Breadcrumbs::render('create_route');
        return view('admin.route.create',[
            'breadcumbs' =>$breadcumbs,
        ]);
    }

    public function store(StoreRouteRequest $request)
    {
        try{
            $city_start = $request->get('city_start_id');
            $city_end = $request->get('city_end_id');
//            dd(1,$request);
            $city_start_name = City::where('name',$city_start)->firstOrFail();
            $city_start_id = $city_start_name->id;
            $city_end_name = City::where('name',$city_end)->firstOrFail();
            $city_end_id = $city_end_name->id;
            $arr = $request->only([
                "name",
                "time",
                "distance",
                "city_start_id",
                "city_end_id",
            ]);
            $arr['city_start_id'] = $city_start_id;
            $arr['city_end_id'] = $city_end_id;
            // @todo cài thư viện image nha php artisan storage:link
            if(isset($request->images)){
                $arr['images'] = optional($request->file('images'))->store('route_images', ['disk' => 'upload']);
            }
//            dd($arr);
            $this->model->create($arr);
//            Tạo tuyến ngược lại

            if($request->get('reverse')==='on'){
                $city_end = $request->get('city_start_id');
                $city_start = $request->get('city_end_id');
//            dd(1,$request);
                $city_start_name = City::where('name',$city_start)->firstOrFail();
                $city_start_id = $city_start_name->id;
                $city_end_name = City::where('name',$city_end)->firstOrFail();
                $city_end_id = $city_end_name->id;
                $name = $city_start_name->name .' - '. $city_end_name->name;
                $arr = $request->only([
                    "time",
                    "distance",
                    "city_start_id",
                    "city_end_id"
                ]);
                $arr['name'] = $name;
                $arr['city_start_id'] = $city_start_id;
                $arr['city_end_id'] = $city_end_id;
                if(isset($request->images)){
                    $arr['images'] = optional($request->file('images'))->store('route_images', ['disk' => 'upload']);
                }
//                dd($arr);
                $this->model->create($arr);
            }
            return redirect()->route('admin.routes.index')->with('success','Bạn thêm thành công !!!');
        }
        catch(Throwable $e){
            return redirect()->route('admin.routes.create')->with('error','Bạn thêm thất bại rồi, vui lòng thử lại sau !!!');
        }
    }


    public function show(Route $route)
    {
        $check_route_driver_car = 0;
        $breadcumbs = Breadcrumbs::render('show_route',$route);
        $city_start = City::where('id',$route->city_start_id)->FirstOrFail();
        $city_start_name = $city_start->name;
        $city_end = City::where('id',$route->city_end_id)->FirstOrFail();
        $city_end_name = $city_end->name;
        $images = 'upload/' . $route->images;
        if (Route_driver_car::where('route_id','=',$route->id)->exists()) {
            $check_route_driver_car = 1;
        }
        return view('admin.route.show',[
            'route'=> $route,
            'breadcumbs'=>$breadcumbs,
            'city_start_name'=>$city_start_name,
            'city_end_name'=>$city_end_name,
            'images'=>$images,
            'check_route_driver_car'=>$check_route_driver_car,
        ]);
    }

    public function edit(Route $route)
    {
        $breadcumbs = Breadcrumbs::render('edit_route',$route);
        $city_start = City::where('id',$route->city_start_id)->FirstOrFail();
        $city_start_name = $city_start->name;
        $city_end = City::where('id',$route->city_end_id)->FirstOrFail();
        $city_end_name = $city_end->name;
        $images = 'upload/' . $route->images;
        return view('admin.route.edit',[
            'route'=> $route,
            'breadcumbs'=>$breadcumbs,
            'city_start_name'=>$city_start_name,
            'city_end_name'=>$city_end_name,
            'images'=>$images
        ]);
    }

    public function update(UpdateRouteRequest $request,$route)
    {
        try{
            $city_start = $request->get('city_start_id');
            $city_end = $request->get('city_end_id');
            $city_start_name = City::where('name',$city_start)->firstOrFail();
            $city_start_id = $city_start_name->id;
            $city_end_name = City::where('name',$city_end)->firstOrFail();
            $city_end_id = $city_end_name->id;
//            dd('new');
            $arr = $request->only([
                "name",
                "time",
                "distance",
                "city_start_id",
                "city_end_id"
            ]);
            $arr['city_start_id'] = $city_start_id;
            $arr['city_end_id'] = $city_end_id;
            if(isset($request->images)){
                $arr['images'] = optional($request->file('images'))->store('route_images', ['disk' => 'upload']);
            }
//            dd($route);
            $object = $this->model->find($route);
            $object -> fill($arr);
            $object->save();
            return redirect()->route('admin.routes.index')->with('success','Bạn sửa thành công !!!');
        }
        catch(Throwable $e){
            return redirect()->back()->with('error','Bạn sửa thất bại rồi,vui lòng thử lại sau !!!');
        }
    }


    public function destroy($route)
    {
        Route::destroy($route);
        return $this->successResponse();
    }
}
