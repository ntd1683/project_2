<?php

namespace Database\Seeders;

use App\Models\Carriage;
use App\Models\Seat;
use Illuminate\Database\Seeder;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [];
        $carriage = Carriage::query()->pluck('id')->toArray();
        $faker = \Faker\Factory::create('vi_VN');
        for ($i = 1; $i <= 1000; $i++) {
            $arr[] = [
                'carriage_id' => $faker->randomElement($carriage),
                'name' => $faker->unique()->regexify('[A-Z]{2}[0-9]{4}-[A-B]-[0-6][0-9]'),
                'status' => $faker->boolean,
            ];
        }
        Seat::insert($arr);
    }
}
