<?php

namespace Database\Seeders;

use App\Models\Carriage;
use App\Models\Seat;
use App\Models\Seat_map;
use Illuminate\Database\Seeder;

class SeatMapSeeder extends Seeder
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
        $carriages = Carriage::query()->pluck('id')->toArray();
        $seats = Seat::query()->pluck('id')->toArray();
        for ($i = 1; $i <= 100; $i++) {
            $arr[] = [
                'carriage_id' => $faker->randomElement($carriages),
                'seat_id' => $faker->randomElement($seats),
            ];
        }
        Seat_map::insert($arr);
    }
}
