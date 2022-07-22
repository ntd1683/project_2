<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddColumnSlotInBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('buses', 'slot')) {
            Schema::table('buses', function (Blueprint $table) {
                $table->integer('slot')->default(0);
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
        if (Schema::hasColumn('buses', 'slot')) {
            Schema::table('buses', function (Blueprint $table) {
                $table->dropColumn('slot');
            });
        }
    }
}
