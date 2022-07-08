<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEditColumnLocationStartIdAndLocationEndIdInRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('routes', function (Blueprint $table) {
            if(Schema::hasColumn('routes','location_start_id') && Schema::hasColumn('routes','location_end_id')) {
                $table->dropForeign('routes_location_end_id_foreign');
                $table->dropForeign('routes_location_start_id_foreign');
                $table->dropIndex('routes_location_start_id_location_end_id_unique');
                $table->dropIndex('routes_location_end_id_foreign');
                $table->dropColumn('location_end_id');
                $table->dropColumn('location_start_id');
            }
        });
    }
}
