<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddColumnBusIdAndBillIdAndSeatIdInTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('tickets','bus_id')){
            Schema::table('tickets',function(Blueprint $table){
                $table->foreignId('bus_id')->constrained('buses');
            });
        }

        if(!Schema::hasColumn('tickets','bill_id')){
            Schema::table('tickets',function(Blueprint $table){
                $table->foreignId('bill_id')->constrained('bills');
            });
        }

        if(!Schema::hasColumn('tickets','seat_id')){
            Schema::table('tickets',function(Blueprint $table){
                $table->foreignId('seat_id')->constrained('seats');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            //
        });
    }
}
