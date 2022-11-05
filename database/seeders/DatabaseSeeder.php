<?php

namespace Database\Seeders;

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
        $this->call(CitySeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(RouteSeeder::class);
        $this->call(CarriageSeeder::class);
        $this->call(BillSeeder::class);
        $this->call(RouteDriverCarSeeder::class);
        $this->call(BusesSeeder::class);
        $this->call(SeatSeeder::class);
        $this->call(SeatMapSeeder::class);
        $this->call(TicketSeeder::class);
        $this->call(GoodSeeder::class);
    }
}
