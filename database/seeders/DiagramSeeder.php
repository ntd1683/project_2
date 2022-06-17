<?php

namespace Database\Seeders;

use App\Enums\SeatType;
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
        for ($i = 1; $i <= 100; $i++) {
            $arr[] = [
                'name' => $faker->boolean ? ($faker->firstName . ' ' . $faker->lastName) : null,
                'diagram' => $faker->imageUrl,
                'seat_type' => $faker->randomElement(SeatType::getValues()),
                'seat_number' => $faker->randomElement(['25', '30', '35', '45', '50', '55', '60']),
            ];
        }
        Diagram::insert($arr);
    }
}
