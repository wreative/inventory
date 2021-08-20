<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('type');
            $table->string('code_phone');
            $table->string('code_card');
            $table->string('no');
            $table->enum('wa', ['Ya', 'Tidak']);
            $table->date('active');
            $table->foreignId('division');
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
        Schema::dropIfExists('device');
    }
}
