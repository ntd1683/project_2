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
        for ($i = 1; $i <= 15; $i++) {
            $city_start_id = $faker->randomElement($city);
            $city_end_id = $faker->randomElement($city);
            while($city_start_id == $city_end_id){
                $city_end_id = $faker->randomElement($city);
            }
            $time = $faker->numberBetween(1, 48);
            $distance = $faker->numberBetween(100, 1000);
            $arr[] = [
                'city_start_id' => $city_start_id,
                'city_end_id' => $city_end_id,
                'name' => City::query()->where('id', $city_start_id)->value('name') . ' - ' . City::query()->where('id', $city_end_id)->value('name'),
                'time' => $time,
                'distance' => $distance,
            ];
            $arr[] = [
                'city_start_id' => $city_end_id,
                'city_end_id' => $city_start_id,
                'name' => City::query()->where('id', $city_end_id)->value('name') . ' - ' . City::query()->where('id', $city_start_id)->value('name'),
                'time' => $time,
                'distance' => $distance,
            ];
        }
        $arr_unique = unique_multidim_array($arr,'name');
        Route::insert($arr_unique);
    }
}
