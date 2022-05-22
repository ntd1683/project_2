<?php

namespace Database\Seeders;

use App\Enums\UserLevelEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr =[];
        $faker = \Faker\Factory::create('vi_VN');
        for ($i=1;$i<=1000;$i++){
            $arr[] = [
                'name'=> $faker->firstName . ' ' . $faker->lastName,
                'phone'=> $faker->phoneNumber,
                'address'=> $faker->address,
                'gender'=> $faker->boolean,
                'birthdate'=> $faker->date,
                'email'=> $faker->email,
                'password'=> $faker->password,
                'level'=> $faker->randomElement(UserLevelEnum::getValues()),
            ];
        }
        User::insert($arr);
    }
}
