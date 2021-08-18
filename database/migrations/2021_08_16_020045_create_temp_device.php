<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempDevice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_device', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('type');
            $table->string('code_phone');
            $table->string('no');
            $table->enum('wa', ['Ya', 'Tidak']);
            $table->date('active');
            $table->date('grace');
            $table->longText('acc')->nullable();
            $table->foreignId('division');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temp_device');
    }
}
