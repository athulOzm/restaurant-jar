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
            $table->integer('status')->default(1);
            $table->time('dtime')->nullable();
            $table->integer('req')->default(0);
            $table->string('delivery_type')->nullable();
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
