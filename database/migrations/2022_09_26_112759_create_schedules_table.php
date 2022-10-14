<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('route_driver_car_id')->constrained('route_driver_cars');
            $table->integer('day_of_week');
            $table->time('time_of_day');
            $table->boolean('pin_double_week')->default(0);
            $table->timestamps();
            $table->unique(['route_driver_car_id', 'day_of_week', 'time_of_day']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
