<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddColumnsCityStartIdAndCityEndIdInRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('routes','city_start_id')){
            Schema::table('routes',function(Blueprint $table){
                $table->foreignId('city_start_id')->constrained('cities');
            });
        }
        if(!Schema::hasColumn('routes','city_end_id')){
            Schema::table('routes',function(Blueprint $table){
                $table->foreignId('city_end_id')->constrained('cities');
            });
        }
        Schema::table('routes',function(Blueprint $table){
            $table->unique(['city_start_id', 'city_end_id']);
        });
    }

}
