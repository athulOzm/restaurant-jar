<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->on('users')
                ->references('id')
                ->onDelete('set null');

            $table->unsignedBigInteger('settlement_id')->nullable();
            $table->foreign('settlement_id')
                ->on('settlements')
                ->references('id')
                ->onDelete('set null');

            $table->integer('status')->default(1);
            $table->time('dtime')->nullable();

            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');

            $table->unsignedBigInteger('menutype_id')->nullable();
            $table->foreign('menutype_id')->references('id')->on('menutypes')->onDelete('set null');
           
            $table->string('delivery_type')->nullable();
            $table->string('vn')->nullable();
            $table->dateTime('delivery_time')->nullable();


            $table->unsignedBigInteger('payment_type_id')->nullable();
            $table->foreign('payment_type_id')
                ->on('payment_types')
                ->references('id')
                ->onDelete('set null');

            $table->unsignedBigInteger('deliverylocation_id')->nullable();
            $table->foreign('deliverylocation_id')
                ->on('deliverylocations')
                ->references('id')
                ->onDelete('set null');

            $table->unsignedBigInteger('table_id')->nullable();
            $table->foreign('table_id')
                ->on('tables')
                ->references('id')
                ->onDelete('set null');

            $table->boolean('payment_status')->default(false);
            $table->decimal('amount', 8, 3)->nullable();
            $table->decimal('paying_amount', 8, 3)->nullable();
            $table->decimal('balance_amount', 8, 3)->nullable();
            $table->decimal('order_discount', 8, 3)->nullable();
            $table->decimal('order_promotion', 8, 3)->nullable();

            $table->text('sn')->nullable();
            $table->integer('made')->default(0);

            $table->unsignedBigInteger('waiter_id')->nullable();
            $table->foreign('waiter_id')
                ->on('users')
                ->references('id')
                ->onDelete('set null');

            $table->unsignedBigInteger('reqfrom')->nullable();
            $table->foreign('reqfrom')
                ->on('users')
                ->references('id')
                ->onDelete('set null');

            

            $table->string('attachment')->nullable();
            $table->string('room_addr')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
