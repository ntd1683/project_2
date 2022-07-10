<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddColumnsToCarriagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('carriages', 'seat_type')) {
            Schema::table('carriages', function (Blueprint $table) {
                $table->integer('seat_type')->default(0)->after('category');
            });
        }
        if (!Schema::hasColumn('carriages', 'default_number_seat')) {
            Schema::table('carriages', function (Blueprint $table) {
                $table->integer('default_number_seat')->default(30)->after('seat_type');
            });
        }
        if (!Schema::hasColumn('carriages', 'slot')) {
            Schema::table('carriages', function (Blueprint $table) {
                $table->integer('slot')->default(0)->after('default_number_seat');
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
        if (Schema::hasColumn('carriages', 'seat_type')) {
            Schema::table('carriages', function (Blueprint $table) {
                $table->dropColumn('seat_type');
            });
        }

        if (Schema::hasColumn('carriages', 'default_number_seat')) {
            Schema::table('carriages', function (Blueprint $table) {
                $table->dropColumn('default_number_seat');
            });
        }

        if (Schema::hasColumn('carriages', 'slot')) {
            Schema::table('carriages', function (Blueprint $table) {
                $table->dropColumn('slot');
            });
        }
    }
}
