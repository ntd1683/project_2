<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDropColumnPinInRouteDriverCarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('route_driver_cars','pin')){
            Schema::table('route_driver_cars',function(Blueprint $table){
                $table->dropColumn('pin');
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
        Schema::table('route_driver_car', function (Blueprint $table) {
            //
        });
    }
}
