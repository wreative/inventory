<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempRental extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_rental', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('address');
            $table->enum('status', ['Lunas', 'Belum']);
            $table->string('pln');
            $table->string('pdam');
            $table->string('pbb');
            $table->string('wifi');
            $table->enum('rental', ['Sewa', 'Hak Milik']);
            $table->date('due');
            $table->longText('info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temp_rental');
    }
}
