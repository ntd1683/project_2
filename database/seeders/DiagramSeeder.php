<?php

namespace Database\Seeders;

use App\Models\Diagram;
use Illuminate\Database\Seeder;

class DiagramSeeder extends Seeder
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
                'name' => $faker->boolean ? ($faker->firstName . ' ' . $faker->lastName) : null,
                'diagram' => $faker->imageUrl,
                'seat_type' => $faker->boolean,
                'seat_number' => $faker->numberBetween(30, 60),
            ];
        }
        Diagram::insert($arr);
    }
}
