<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddColumnColorInCarriagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('carriages','color')){
            Schema::table('carriages',function(Blueprint $table){
                $table->integer('color')->default(0)->after('default_number_seat');
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
        if (Schema::hasColumn('carriages', 'color')) {
            Schema::table('carriages', function (Blueprint $table) {
                $table->dropColumn('color');
            });
        }
    }
}
