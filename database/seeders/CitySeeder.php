<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
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
        for ($i = 1; $i <= 20; $i++) {
            $name = $faker->unique()->province;
            if($name == "Bà Rịa - Vũng Tàu"){
                $name = "Bà Rịa Vũng Tàu";
            }
            $arr[] = [
                'name' => $name,
            ];
        }
        City::insert($arr);
    }
}
