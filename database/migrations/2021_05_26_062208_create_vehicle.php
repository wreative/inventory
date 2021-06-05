<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('type');
            $table->string('brand');
            $table->string('plat');
            $table->string('step');
            $table->string('engine');
            $table->date('kir');
            $table->date('tax');
            $table->date('stnk');
            $table->longText('info')->nullable();
            $table->boolean('add')->nullable();
            $table->boolean('edit')->nullable();
            $table->boolean('del')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle');
    }
}
