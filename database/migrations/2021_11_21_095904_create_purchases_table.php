<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->on('branches')->references('id')->onDelete('cascade');

            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->on('suppliers')->references('id')->onDelete('cascade');

            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->on('materials')->references('id')->onDelete('cascade');

            $table->decimal('quantity', 8, 1)->nullable()->default(1);
            $table->decimal('price', 8, 3)->default(0);
            $table->decimal('vat', 8, 3)->default(0);
            $table->boolean('payment')->default(1);


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
        Schema::dropIfExists('purchases');
    }
}
