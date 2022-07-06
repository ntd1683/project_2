<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarriagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carriages', function (Blueprint $table) {
            $table->id();
            $table->string('license_plate')->unique();
            $table->string('category')->nullable();
            $table->integer('seat_type')->default(0);
            $table->integer('default_number_seat')->default(30);
            $table->integer('slot')->default(0);
            // $table->foreignId('diagram_id')->constrained('diagrams');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carriages');
    }
}
