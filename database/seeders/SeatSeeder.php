<?php

namespace Database\Seeders;

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
        $faker = \Faker\Factory::create('vi_VN');
        $floor = 1;
        $name = 'A';
        $check = false;
        $i = 1;
        do{
            if($i === 21){
                $name = 'B';
                $floor++;
                $i = 1;
            }
            $arr[] = [
                'name' => $name . $i,
                'floor' => $floor,
            ];
            $i++;
            if($i === 21 && $floor === 2){
                $check = true;
            }
        }while($check == false);
        Seat::insert($arr);
    }
}
