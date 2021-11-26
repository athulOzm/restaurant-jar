<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialPurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_purchase', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unique(['purchase_id', 'material_id']);
            


            $table->unsignedBigInteger('purchase_id');
            $table->foreign('purchase_id')
                ->on('purchases')
                ->references('id')
                ->onDelete('cascade');

            $table->unsignedBigInteger('material_id')->nullable();
            $table->foreign('material_id')
                ->on('materials')
                ->references('id')
                ->onDelete('cascade');

           
            $table->decimal('quantity', 8, 3)->nullable()->default(1);
            $table->decimal('quantityrec', 8, 3)->nullable()->default(0);
 
            $table->decimal('unit_price', 8, 3)->nullable();
            $table->decimal('price', 8, 3)->nullable();
         
            $table->decimal('tax', 8, 3)->default(0);
            $table->decimal('tax_value', 8, 3)->default(0);
            $table->boolean('tax_unit')->default(0);

            $table->decimal('discount', 8, 3)->default(0);
            $table->decimal('discount_value', 8, 3)->default(0);
            $table->boolean('discount_unit')->default(0);

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
        Schema::dropIfExists('material_purchase');
    }
}
