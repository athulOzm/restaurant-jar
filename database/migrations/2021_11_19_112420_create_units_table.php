<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unit_code');
            $table->string('unit_name');
            $table->unsignedBigInteger('base_unit')->nullable();
            $table->string('operator');
            $table->double('operation_value');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->foreign('base_unit')
                ->on('units')
                ->references('id')
                ->onDelete('cascade');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
}
