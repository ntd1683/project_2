<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned();
            $table->foreignId('bill_detail_id')->constrained();
            $table->foreignId('from_address2_id')->constrained('address2s');
            $table->foreignId('to_address2_id')->constrained('address2s');
            $table->string('name', 100);
            $table->string('phone', 20);
            $table->timestamps();
            $table->primary(['id', 'bill_detail_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
