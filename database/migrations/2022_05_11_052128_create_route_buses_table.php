<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_buses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_address1_id')->constrained('address1s');
            $table->foreignId('to_address1_id')->constrained('address1s');
            $table->string('name');
            $table->time('time')->nullable();
            $table->integer('distance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('route_buses');
    }
}
