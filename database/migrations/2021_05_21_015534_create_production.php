<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('brand');
            $table->integer('qty');
            $table->bigInteger('price_acq');
            $table->date('date_acq');
            $table->enum('condition', ['Ada', 'Tidak Ada', 'Rusak', 'Hilang']);
            $table->json('img');
            $table->longText('info')->nullable();
            $table->foreignId('category');
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
        Schema::dropIfExists('production');
    }
}
