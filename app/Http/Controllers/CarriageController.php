<?php

namespace App\Http\Controllers;

use App\Enums\SeatTypeEnum;
use App\Models\Carriage;
use App\Http\Requests\StoreCarriageRequest;
use App\Http\Requests\UpdateCarriageRequest;
use Diglactic\Breadcrumbs\Breadcrumbs;
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

        View::share([
            'title' => ucwords($this->table),
            'route' => $route,
        ]);
    }

    public function api()
    {
        return DataTables::of($this->model)
            ->editColumn('seat_type', function ($model) {
                return SeatTypeEnum::getKeyByValue($model->seat_type);
            })
            ->addColumn('edit', function ($object) {
                return route('admin.carriages.edit', $object);
            })
            ->addColumn('delete', function ($object) {
                return 2;
            })
            ->make(true);
    }

    public function show_cars()
    {
        $breadcumbs = Breadcrumbs::render('carriage');
        return view('admin.carriage.index', [
            'breadcumbs' => $breadcumbs,
            'title' => 'Danh sách xe',
        ]);
    }

    public function index()
    {
        //
    }

    public function create()
    {
        $breadcumbs = Breadcrumbs::render('carriage.create');
        return view('admin.carriage.create', [
            'breadcumbs' => $breadcumbs,
            'title' => 'Thêm mới xe',
        ]);
    }

    public function store(StoreCarriageRequest $request)
    {
        //
    }

    public function edit(Carriage $carriage)
    {
    }


    public function update(UpdateCarriageRequest $request, Carriage $carriage)
    {
        //
    }

    public function destroy(Carriage $carriage)
    {
        //
    }
}
