<?php

namespace Database\Seeders;

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
        $location = Location::query()->pluck('id')->toArray();
        $faker = \Faker\Factory::create('vi_VN');
        for ($i = 1; $i <= 500; $i++) {
            $arr[] = [
                'location_start_id' => $faker->randomElement($location),
                'location_end_id' => $faker->randomElement($location),
                'name' => $faker->boolean ? ($faker->firstName . ' ' . $faker->lastName . ' - ' . $faker->firstName . ' ' . $faker->lastName) : null,
                'time' => $faker->boolean ? ($faker->numberBetween(1, 48)) : null,
                'distance' => $faker->boolean ? ($faker->numberBetween(15, 200)) : null,
            ];
        }
        Route::insert($arr);
    }
}
