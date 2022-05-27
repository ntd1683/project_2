<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
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
                'name' => $faker->boolean ? ($faker->firstName . ' ' . $faker->lastName) : null,
                'address' => $faker->streetAddress . ', ' . $faker->hamletName,
                'district' => $faker->districtName,
                'city' => $faker->province,
            ];
        }
        Location::insert($arr);
    }
}
