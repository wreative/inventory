<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRental extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('address');
            $table->enum('status', ['Lunas', 'Belum']);
            $table->integer('pln');
            $table->integer('pdam');
            $table->integer('pbb');
            $table->integer('wifi');
            $table->enum('rental', ['Lunas', 'Hak Milik']);
            $table->date('due');
            $table->boolean('add')->nullable();
            $table->boolean('edit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rental');
    }
}
