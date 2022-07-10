<?php

namespace App\Http\Controllers;

use App\Models\Carriage;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class TestController extends Controller
{
    private object $model;
    private string $table;

    public function __construct()
    {
        $this->model = Carriage::query();
        $this->table = (new Carriage())->getTable();

        View::share('title', ucwords($this->table));
        View::share('table', $this->table);
    }

    public function test()
    {
        return view('test');
    }

    public function apiTest()
    {
        return DataTables::of($this->model)
            ->addColumn('edit', function ($model) {
                // return route('admin.carriage.edit', $model->id);
            })
            ->addColumn('delete', function ($model) {
                // return route('admin.carriage.destroy', $model->id);
            })
            ->rawColumns(['edit', 'delete'])
            ->make(true);
    }

    public function test1()
    {
        return view('admin.route.test');
    }
}
