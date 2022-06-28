<?php

namespace Database\Seeders;

use App\Models\Carriage;
use App\Models\Route;
use App\Models\Route_driver_car;
use App\Models\User;
use Illuminate\Database\Seeder;

class RouteDriverCarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [];
        $route = Route::query()->pluck('id')->toArray();
        $user = User::query()->pluck('id')->toArray();
        $carriage = Carriage::query()->pluck('id')->toArray();
        $faker = \Faker\Factory::create('vi_VN');
        for ($i = 1; $i <= 1000; $i++) {
            $driver_id = $faker->randomElement($user);
            $driver_level = User::query()->where('id', $driver_id)->value('level');
            if ($driver_level == 0) {
                $arr[] = [
                    'route_id' => $faker->randomElement($route),
                    'driver_id' => $driver_id,
                    'car_id' => $faker->randomElement($carriage),
                    'price' => $faker->numberBetween(80000, 1000000),
                ];
            }
        }
        Route_driver_car::insert($arr);
    }
}
