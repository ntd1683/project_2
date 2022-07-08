<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDatatypesCategoryColumnInCarriageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // delete old column
        if (Schema::hasColumn('carriages', 'category')) {
            Schema::table('carriages', function (Blueprint $table) {
                $table->dropColumn('category');
            });
        }

        if (!Schema::hasColumn('carriages', 'category')) {
            Schema::table('carriages', function (Blueprint $table) {
                $table->integer('category')->default(0)->after('license_plate');
            });
        }
    }
}
