<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_details', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned();
            $table->foreignId('bill_id')->constrained();
            $table->foreignId('seat_id')->constrained();
            $table->foreignId('buses_id')->constrained();
            $table->integer('price');
            $table->primary(['id', 'bill_id', 'seat_id', 'buses_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_details');
    }
}
