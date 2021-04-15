<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_id');

            $table->foreign('order_id')
                ->on('orders')
                ->references('id')
                ->onDelete('cascade');

            $table->string('product_id');
            $table->foreign('product_id')
                ->on('products')
                ->references('id')
                ->onDelete('cascade');

            $table->string('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_list');
    }
}
