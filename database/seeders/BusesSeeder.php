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
        $faker = \Faker\Factory::create('vi_VN');
        for ($i = 1; $i <= 1000; $i++) {
            $arr[] = [
                'route_driver_car_id' => Route_driver_car::query()->inRandomOrder()->value('id'),
                'departure_time' => $faker->dateTimeBetween('-1 years', '+1 years'),
                // 'status' => null,
            ];
        }
        Buses::insert($arr);
    }
}
