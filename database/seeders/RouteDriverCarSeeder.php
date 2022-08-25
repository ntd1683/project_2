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
        $user = User::query()->where('level', '0')->pluck('id')->toArray();
        $carriage = Carriage::query()->pluck('id')->toArray();
        $faker = \Faker\Factory::create('vi_VN');
        foreach ($carriage as $car) {
            $driver_id = $faker->randomElement($user);
            $route_id = $faker->randomElement($route);
            while ($route_id % 2 == 0){
                $route_id = $faker->randomElement($route);
            }
            $arr[] = [
                'route_id' => $route_id,
                'driver_id' => $driver_id,
                'car_id' => $car,
                'price' => $faker->numberBetween(80000, 1000000),
            ];
            $arr[] = [
                'route_id' => $route_id + 1,
                'driver_id' => $driver_id,
                'car_id' => $car,
                'price' => $faker->numberBetween(80000, 1000000),
            ];
        }
        Route_driver_car::insert($arr);
    }
}
