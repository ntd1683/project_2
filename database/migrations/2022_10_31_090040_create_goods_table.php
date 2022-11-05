<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bus_id')->constrained('buses');
            $table->foreignId('bill_id')->constrained('bills');$table->string('code', 20)->unique();
            $table->string('name_passenger', 50);
            $table->string('phone_passenger', 20)->nullable();
            $table->string('email_passenger', 50)->nullable();
            $table->foreignId('address_passenger_id')->nullable()->constrained('locations');
            $table->float('price');
            $table->softDeletes();
            $table->timestamps();
            $table->unique(["bus_id", "bill_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
}
