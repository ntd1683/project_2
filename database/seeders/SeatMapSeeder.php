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
            $carriage_id = $faker->unique()->randomElement($carriages);
            $number_seat = $faker->randomElement([20, 34,42]);
            for($j = 1; $j<=$number_seat/2; $j++){
                $arr[] = [
                    'carriage_id' => $carriage_id,
                    'seat_id' => $j,
                ];
            }
            for($j = 1; $j<=$number_seat/2; $j++){
                $arr[] = [
                    'carriage_id' => $carriage_id,
                    'seat_id' => $j+20,
                ];
            }
        }
        Seat_map::insert($arr);
    }
}
