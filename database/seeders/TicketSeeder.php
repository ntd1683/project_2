<?php

namespace Database\Seeders;

use App\Models\Bill_detail;
use App\Models\Location;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
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
        $locations = Location::query()->pluck('id')->toArray();
        for ($i = 1; $i <= 100; $i++) {
            $arr[] = [
                'bill_detail_id' => Bill_detail::query()->where('id', $i)->value('id'),
                'code' => $faker->regexify('[A-Z0-9]{10}'),
                'name_passenger' =>$faker->firstName . ' ' . $faker->lastName,
                'phone_passenger' =>$faker->phoneNumber,
                'email_passenger' => $faker->email,
                'address_passenger_id' => $faker->randomElement($locations),
                'created_at' => $faker->dateTimeBetween('-1 years', 'now'),
            ];
        }
        Ticket::insert($arr);
    }
}
