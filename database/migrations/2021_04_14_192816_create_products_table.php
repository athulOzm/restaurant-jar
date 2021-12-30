<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('name_ar')->nullable();
            $table->boolean('status')->default(true);

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');

            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->foreign('subcategory_id')->references('id')->on('categories')->onDelete('set null');

            $table->unsignedBigInteger('promotion_id')->nullable();
            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('set null');

            $table->decimal('price', 8, 3)->nullable();

            $table->boolean('variant')->default(false);

            $table->string('v1_name');
            $table->string('v2_name');
            $table->string('v3_name');
            $table->string('v4_name');
            $table->decimal('v1_price', 8, 3)->nullable();
            $table->decimal('v2_price', 8, 3)->nullable();
            $table->decimal('v3_price', 8, 3)->nullable();
            $table->decimal('v4_price', 8, 3)->nullable();


            $table->decimal('vat', 8, 2)->default(0);
            $table->decimal('qty', 8, 1)->nullable()->default(10);
            $table->longText('body')->nullable();
            $table->string('cover')->nullable();

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
        Schema::dropIfExists('products');
    }
}
