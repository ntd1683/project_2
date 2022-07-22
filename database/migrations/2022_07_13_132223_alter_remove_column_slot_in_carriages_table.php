<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRemoveColumnSlotInCarriagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('carriages', 'slot')) {
            Schema::table('carriages', function (Blueprint $table) {
                $table->dropColumn('slot');
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
        if (!Schema::hasColumn('carriages', 'slot')) {
            Schema::table('carriages', function (Blueprint $table) {
                $table->integer('slot')->default(0);
            });
        }
    }
}
