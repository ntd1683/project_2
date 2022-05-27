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
        $faker = \Faker\Factory::create('vi_VN');
        for ($i = 1; $i <= 100; $i++) {
            $arr[] = [
                'location_start_id' => Location::query()->inRandomOrder()->value('id'),
                'location_end_id' => Location::query()->inRandomOrder()->value('id'),
                'name' => $faker->boolean ? ($faker->firstName . ' ' . $faker->lastName . ' - ' . $faker->firstName . ' ' . $faker->lastName) : null,
                'time' => $faker->boolean ? ($faker->numberBetween(1, 48)) : null,
                'distance' => $faker->boolean ? ($faker->numberBetween(15, 200)) : null,
            ];
        }
        Route::insert($arr);
    }
}
