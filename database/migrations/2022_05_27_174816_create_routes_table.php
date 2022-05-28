<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_start_id')->constrained('locations');
            $table->foreignId('location_end_id')->constrained('locations');
            $table->string('name')->nullable();
            $table->float('time')->nullable();
            $table->integer('distance')->nullable();

            //set unique 2 columns 'location_start_id' and 'location_end_id'
            $table->unique(['location_start_id', 'location_end_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
    }
}
