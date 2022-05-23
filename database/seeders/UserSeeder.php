<?php

namespace Database\Seeders;

use App\Enums\UserLevelEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
                'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token'=>null,
                'level'=> $faker->randomElement(UserLevelEnum::getValues()),
            ];
        }
        User::insert($arr);
    }
}
