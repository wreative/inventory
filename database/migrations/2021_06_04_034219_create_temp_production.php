<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempProduction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_prod', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('brand');
            $table->integer('qty');
            $table->bigInteger('price_acq');
            $table->string('date_acq');
            $table->enum('condition', ['Ada', 'Tidak Ada', 'Rusak', 'Hilang']);
            $table->json('img');
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
        Schema::dropIfExists('temp_prod');
    }
}
