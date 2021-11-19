<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcategories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parant_id')->nullable();
            $table->string('name');
            $table->string('cover')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->foreign('parant_id')
                ->on('categories')
                ->references('id')
                ->onDelete('cascade');

            $table->boolean('is_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pcategories');
    }
}
