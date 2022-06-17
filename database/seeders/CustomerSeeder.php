<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
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
        for ($i = 1; $i <= 10000; $i++) {
            $arr[] = [
                'name' => $faker->firstName . ' ' . $faker->lastName,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'address' => $faker->boolean ? ($faker->streetAddress . ', ' . $faker->hamletName . ', ' . $faker->districtName . ', ' . $faker->province) : null,
                'gender' => $faker->boolean,
                'birthday' => $faker->boolean ? ($faker->date) : null
            ];
            if ($i % 1000 === 0) {
                Customer::insert($arr);
                $arr = [];
            }
        }
    }
}
