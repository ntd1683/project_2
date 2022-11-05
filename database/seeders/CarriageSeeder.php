<?php

namespace Database\Seeders;

use App\Enums\CarriageCategoryEnum;
use App\Enums\CarriageColorEnum;
use App\Enums\SeatTypeEnum;
use App\Models\Carriage;
use App\Models\Diagram;
use Illuminate\Database\Seeder;

class CarriageSeeder extends Seeder
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
        for ($i = 1; $i <= 100; $i++) {
            $arr[] = [
                'license_plate' => $faker->unique()->regexify('[0-9]{1,2}-[A-Z0-9]{1,2}-[0-9]{4,5}'),
                'category' => $faker->randomElement(CarriageCategoryEnum::getValues()),
                'type' => $faker->randomElement(SeatTypeEnum::getValues()),
                'color' => $faker->randomElement(CarriageColorEnum::getValues()),
            ];
        }
        Carriage::insert($arr);
    }
}
