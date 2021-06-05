<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddonOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addon_order_product', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unique(['order_product_id', 'addon_id']);


            $table->unsignedBigInteger('order_product_id');


            $table->foreign('order_product_id')
                ->on('order_product')
                ->references('id')
                ->onDelete('cascade');

            $table->unsignedBigInteger('addon_id');
            $table->foreign('addon_id')
                ->on('addons')
                ->references('id')
                ->onDelete('cascade');

            $table->decimal('quantity', 8, 1)->nullable()->default(1);
            $table->decimal('discount', 8, 3)->default(0);
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
        Schema::dropIfExists('addon_order_product');
    }
}
