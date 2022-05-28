<?php

namespace Database\Seeders;

use App\Models\Carriage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(RouteSeeder::class);
        $this->call(DiagramSeeder::class);
        $this->call(CarriageSeeder::class);
    }
}
