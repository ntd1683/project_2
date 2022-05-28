<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagrams', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('diagram');
            $table->integer('seat_type')->default(1);
            $table->integer('seat_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagrams');
    }
}
