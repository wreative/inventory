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
            $table->string('pln')->nullable();
            $table->date('due_pln')->nullable();
            $table->string('pdam')->nullable();
            $table->date('due_pdam')->nullable();
            $table->string('wifi')->nullable();
            $table->date('due_wifi')->nullable();
            $table->string('pbb')->nullable();
            $table->enum('rental', ['Sewa', 'Hak Milik']);
            $table->date('due');
            $table->enum('due_type', ['Bulanan', 'Tahunan']);
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
        Schema::dropIfExists('rental');
    }
}
