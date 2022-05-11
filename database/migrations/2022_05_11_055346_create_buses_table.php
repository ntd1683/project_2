<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('route_driver_id')->constrained();
            $table->foreignId('carriage_id')->constrained('carriages');
            $table->foreignId('price_default_id')->constrained('price_defauts');
            $table->foreignId('price_adjustment_id')->constrained('price_adjustments');
            $table->time('departure_time');
            // $table->primary(['route_driver_id', 'carrage_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buses');
    }
}
