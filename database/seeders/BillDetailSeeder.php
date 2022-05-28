<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Bill_detail;
use App\Models\Buses;
use App\Models\Seat;
use Illuminate\Database\Seeder;

class BillDetailSeeder extends Seeder
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
        for ($i = 1; $i <= 500; $i++) {
            $arr[] = [
                'seat_id' => Seat::query()->inRandomOrder()->value('id'),
                'buses_id' => Buses::query()->inRandomOrder()->value('id'),
                'bill_id' => Bill::query()->inRandomOrder()->value('id'),
                'price' => $faker->numberBetween(80000, 1000000),
            ];
        }
        Bill_detail::insert($arr);
    }
}
