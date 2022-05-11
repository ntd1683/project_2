<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_drivers', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned();
            // foreign key constraints
            $table->foreignId('route_buses_id')->unsigned()->constrained();
            $table->foreignId('driver_id')->unsigned()->constrained();
            $table->primary(['id', 'route_buses_id', 'driver_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('route_drivers');
    }
}
