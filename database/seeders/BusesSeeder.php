<?php

namespace Database\Seeders;

use App\Models\Buses;
use App\Models\Route_driver_car;
use Illuminate\Database\Seeder;

class BusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [];
        $route_driver_car = Route_driver_car::query()->pluck('id')->toArray();
        $faker = \Faker\Factory::create('vi_VN');
        for ($i = 1; $i <= 1000; $i++) {
            $arr[] = [
                'route_driver_car_id' => $faker->randomElement($route_driver_car),
                'departure_time' => $faker->dateTimeBetween('-1 years', 'now'),
                // 'status' => null,
            ];
            if ($i % 100 == 0) {
                Buses::insert($arr);
                $arr = [];
            }
        }
    }
}
