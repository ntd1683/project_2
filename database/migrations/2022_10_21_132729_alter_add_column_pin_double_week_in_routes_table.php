<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddColumnPinDoubleWeekInRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('routes','pin_double_week')){
            Schema::table('routes',function(Blueprint $table){
                $table->boolean('pin_double_week')->default(0)->after('pin');
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
        if(Schema::hasColumn('routes','pin_double_week')){
            Schema::table('routes',function(Blueprint $table){
                $table->dropColumn('pin_double_week');
            });
        }
    }
}
