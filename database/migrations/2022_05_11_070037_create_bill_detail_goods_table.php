<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillDetailGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_detail_goods', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned();
            $table->foreignId('bill_id')->constrained();
            $table->foreignId('buses_id')->constrained();
            $table->foreignId('goods_id')->constrained();
            $table->integer('price');
            $table->primary(['id', 'bill_id', 'buses_id', 'goods_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_detail_goods');
    }
}
