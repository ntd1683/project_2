<?php

namespace Database\Seeders;

use App\Models\Route_driver_car;
use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
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
                'day_of_week' => $faker->numberBetween(0, 6),
                'time_of_day' => $faker->time('H:i'),
            ];
        }
        Schedule::insert($arr);
    }
}
