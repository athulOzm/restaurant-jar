<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->boolean('is_active')->default(true);

           

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('pcategories')->onDelete('set null');

            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->foreign('subcategory_id')->references('id')->on('pcategories')->onDelete('set null');

            $table->unsignedBigInteger('unit_id')->nullable();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('set null');

            $table->unsignedBigInteger('punit_id')->nullable();
            $table->foreign('punit_id')->references('id')->on('units')->onDelete('set null');

           

            $table->decimal('price', 8, 3)->nullable();

            $table->decimal('vat', 8, 2)->default(0);
            $table->decimal('stock', 8, 1)->nullable()->default(10);
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
        Schema::dropIfExists('materials');
    }
}
