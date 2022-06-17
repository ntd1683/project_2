<?php

namespace Database\Seeders;

use App\Models\Bill_detail;
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
        for ($i = 1; $i <= 1000; $i++) {
            $arr[] = [
                'bill_detail_id' => Bill_detail::query()->where('id', $i)->value('id'),
                'code' => $faker->regexify('[A-Z0-9]{10}'),
                'name_passenger' => $faker->boolean ? ($faker->firstName . ' ' . $faker->lastName) : null,
                'phone_passenger' => $faker->boolean ? ($faker->phoneNumber) : null,
                'email_passenger' => $faker->boolean ? ($faker->email) : null,
            ];
        }
        Ticket::insert($arr);
    }
}
