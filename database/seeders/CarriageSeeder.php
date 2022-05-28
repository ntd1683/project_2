<?php

namespace Database\Seeders;

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
        for ($i = 1; $i <= 50; $i++) {
            $arr[] = [
                'license_plate' => $faker->unique()->regexify('[A-Z]{2}[0-9]{4}'),
                'category' => $faker->boolean ? ($faker->firstName . ' ' . $faker->lastName) : null,
                'diagram_id' => Diagram::query()->inRandomOrder()->value('id'),
            ];
        }
        Carriage::insert($arr);
    }
}
