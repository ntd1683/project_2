<?php

namespace App\Http\Controllers;

use App\Enums\CarriageCategoryEnum;
use App\Enums\SeatTypeEnum;
use App\Models\Bill;
use App\Models\Bill_detail;
use App\Models\Buses;
use App\Models\Carriage;
use App\Models\Customer;
use App\Models\Route;
use App\Models\Route_driver_car;
use Illuminate\Support\Str;
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
        $this->model = (new Route())->query();
        $this->table = (new Route())->getTable();
    }

    public function test()
    {
        $first = (new Buses())->get_first_day_of_week('34', '2022');
        $last = (new Buses())->get_last_day_of_week('34', '2022');
        return [$first, $last];
    }
}
