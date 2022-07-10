<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Location;
use App\Models\Route;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
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
        $city = City::query()->pluck('id')->toArray();
        for ($i = 1; $i <= 20; $i++) {
            $arr[] = [
                'city_start_id' => $faker->randomElement($city),
                'city_end_id' => $faker->randomElement($city),
                'name' => $faker->boolean ? ($faker->firstName . ' ' . $faker->lastName . ' - ' . $faker->firstName . ' ' . $faker->lastName) : null,
                'time' => $faker->numberBetween(1, 48),
                'distance' => $faker->numberBetween(15, 200),
            ];
        }
        Route::insert($arr);
    }
}
