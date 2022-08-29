<?php

namespace App\Http\Controllers;

use App\Enums\CarriageCategoryEnum;
use App\Enums\SeatTypeEnum;
use App\Models\Bill;
use App\Models\Bill_detail;
use App\Models\Buses;
use App\Models\Carriage;
use App\Models\City;
use App\Models\Customer;
use App\Models\Location;
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
        $arr = [];
        $faker = \Faker\Factory::create('vi_VN');
        $locations = Location::query()->pluck('id')->toArray();
        for ($i = 1; $i <= 100; $i++) {
            $arr[] = [
                'bill_detail_id' => Bill_detail::query()->where('id', $i)->value('id'),
                'code' => $faker->regexify('[A-Z0-9]{10}'),
                'name_passenger' =>$faker->firstName . ' ' . $faker->lastName,
                'phone_passenger' =>$faker->phoneNumber,
                'email_passenger' => $faker->email,
                'address_passenger_id' => $faker->randomElement($locations),
            ];
        }
        return $arr;
    }
}
