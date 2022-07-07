<?php

namespace Database\Seeders;

use App\Enums\CarriageCategoryEnum;
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
        // $diagram = Diagram::query()->pluck('id')->toArray();
        $faker = \Faker\Factory::create('vi_VN');
        for ($i = 1; $i <= 100; $i++) {
            $arr[] = [
                'license_plate' => $faker->unique()->regexify('[0-9]{1,2}-[A-Z0-9]{1,2}-[0-9]{4,5}'),
                'category' => $faker->randomElement(CarriageCategoryEnum::getValues()),
                // 'diagram_id' => $faker->randomElement($diagram),
                'seat_type' => $faker->randomElement(SeatTypeEnum::getValues()),
                'default_number_seat' => $faker->randomElement([30, 40, 50, 60, 70, 80]),
            ];
        }
        Carriage::insert($arr);
    }
}
