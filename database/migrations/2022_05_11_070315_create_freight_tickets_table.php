<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreightTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freight_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_detail_goods_id')->constrained();
            $table->foreignId('from_address2_id')->constrained('address2s');
            $table->foreignId('recipient_address2_id')->constrained('address2s');
            $table->string('name', 50);
            $table->string('phone', 20);
            $table->string('email', 100)->nullable();
            $table->string('note', 100)->nullable();
            $table->string('recipient_name', 50);
            $table->string('recipient_phone', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('freight_tickets');
    }
}
