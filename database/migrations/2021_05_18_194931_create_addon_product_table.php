<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddonProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addon_product', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unique(['product_id', 'addon_id']);

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
                ->on('products')
                ->references('id')
                ->onDelete('cascade');

            $table->unsignedBigInteger('addon_id');
            $table->foreign('addon_id')
                ->on('addons')
                ->references('id')
                ->onDelete('cascade');

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
        Schema::dropIfExists('addon_product');
    }
}
