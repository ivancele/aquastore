<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFishTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fish', function (Blueprint $table) {
            $table->id();
            $table->integer('aquarium_id'); //Fish needs to be in aquarium and it can only be in one, therefore one to one relationship
            $table->string('common_name'); //Common name or human name
            $table->string('species'); //Species or scientific name
            $table->string('color');
            $table->integer('fins');
            $table->double('weight')->nullable(); //Weight in grams
            $table->double('length')->nullable(); //Length in CMs
            $table->double('avg_aquarium_temperature')->nullable(); //
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fish');
    }
}
