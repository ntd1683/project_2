<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDropColumnDefaultNumberSeatInCarriagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if(Schema::hasColumn('carriages','default_number_seat')){
            Schema::table('carriages',function(Blueprint $table){
                $table->dropColumn('default_number_seat');
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
        Schema::table('carriages', function (Blueprint $table) {
            //
        });
    }
}
