<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('memberid')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->unsignedBigInteger('rank_id')->nullable();
            $table->unsignedBigInteger('payment_type_id')->nullable();
            $table->integer('type')->default(3);
            $table->decimal('limit', 9, 3)->nullable()->default(null);
            $table->integer('item_limit')->default(5)->nullable();
            $table->string('room_address')->nullable();
            $table->string('location')->nullable();

            $table->rememberToken();
            $table->timestamps();

            $table->foreign('rank_id')
                ->on('ranks')
                ->references('id')
                ->onDelete('set null');

            $table->foreign('payment_type_id')
                ->on('payment_types')
                ->references('id')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
