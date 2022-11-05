<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Buses;
use App\Models\Good;
use App\Models\Location;
use App\Models\Seat;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class GoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [];
        $arrtmp = [];
        $faker = \Faker\Factory::create('vi_VN');
        $locations = Location::query()->pluck('id')->toArray();
        $buses = Buses::query()->pluck('id')->toArray();
        $bills = Bill::query()->pluck('id')->toArray();
        for ($i = 1; $i <= 100; $i++) {
            do{
                $bus_id = $faker->randomElement($buses);
                $bill_id = $faker->randomElement($bills);
                $tmp['bus'] = $bus_id;
                $tmp['bill'] = $bill_id;
                if(check_not_exist_in_array_good_seat($arrtmp,$tmp)===true){
                    break;
                }
            }while(1);
            $arrtmp[]=[
                'bus_id' => $bus_id,
                'bill_id' => $bill_id,
            ];
            $arr[] = [
                'code' => $faker->regexify('[A-Z0-9]{10}'),
                'name_passenger' =>$faker->firstName . ' ' . $faker->lastName,
                'phone_passenger' =>$faker->phoneNumber,
                'email_passenger' => $faker->email,
                'address_passenger_id' => $faker->randomElement($locations),
                'price' => $faker->numberBetween(80000, 1000000),
                'bus_id' => $faker->randomElement($buses),
                'bill_id' => $faker->randomElement($bills),
                'created_at' => $faker->dateTimeBetween('-1 years', 'now'),
            ];
        }
        Good::insert($arr);
    }
}
