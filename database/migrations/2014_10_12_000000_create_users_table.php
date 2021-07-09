<?php

use Carbon\Carbon;
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

            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');

            $table->string('name');
            $table->string('ar_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('renewal_at')->default(Carbon::now()->addyear())->nullable();
            $table->string('password')->nullable();
            $table->string('code')->nullable();
            $table->string('memberid')->nullable();
            $table->string('serviceid')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->unsignedBigInteger('rank_id')->nullable();
            $table->unsignedBigInteger('payment_type_id')->nullable();
            $table->integer('type')->default(3);
            $table->decimal('limit', 9, 3)->nullable()->default(null);
            $table->integer('item_limit')->default(5)->nullable();
            $table->string('room_address')->nullable();
            $table->string('location')->nullable();
            $table->boolean('status')->default(true);


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

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')
                ->on('member_categories')
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
