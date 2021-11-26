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

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->on('users')
                ->references('id')
                ->onDelete('set null');


            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->on('branches')->references('id')->onDelete('cascade');

            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id')->on('suppliers')->references('id')->onDelete('cascade');

            

            $table->decimal('quantity', 8, 1)->nullable()->default(1);
            $table->decimal('tot_price', 8, 3)->default(0);
            $table->decimal('shipping_cost', 8, 3)->default(0);

            $table->decimal('tot_discount', 8, 3)->default(0);
            $table->decimal('discount_value', 8, 3)->default(0);
            $table->boolean('discount_unit')->default(0);

            $table->string('reference')->nullable();

            $table->unsignedBigInteger('payment_status_id')->nullable();
            $table->foreign('payment_status_id')->on('payment_statuses')->references('id')->onDelete('set null');

            $table->unsignedBigInteger('purchase_status_id')->nullable();
            $table->foreign('purchase_status_id')->on('purchase_statuses')->references('id')->onDelete('set null');


            
            $table->boolean('status')->default(1);
            $table->text('note')->nullable();
            $table->dateTime()->nullable();


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
