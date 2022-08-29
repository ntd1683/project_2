<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [];
        $customer = Customer::query()->pluck('id')->toArray();
        $faker = \Faker\Factory::create('vi_VN');
        for ($i = 1; $i <= 1000; $i++) {
            $arr[] = [
                'customer_id' => $faker->randomElement($customer),
                'code' => $faker->unique()->regexify('[A-Z0-9]{8}'),
                'price' => $faker->numberBetween(80000, 1000000),
                'payment_method' =>$faker->randomElement([0 ,1, 2, 3]),
                'status' =>$faker->numberBetween(0, 1),
                'created_at' => $faker->dateTimeBetween('-1 years', 'now'),
            ];
        }
        Bill::insert($arr);
    }
}
