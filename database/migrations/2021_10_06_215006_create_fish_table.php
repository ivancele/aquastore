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
            $table->integer('fins'); //Some of these numbers are just arbitrary values
            $table->double('weight')->nullable(); //Weight in grams
            $table->double('length')->nullable(); //Length in CMs
            $table->double('avg_aquarium_temperature')->nullable(); //
            $table->integer('age')->nullable(); //Age in months //TODO: convert to years on get
            $table->string('diet')->nullable();
            $table->double('min_aquarium_size')->default(0); //Zero if no minimum is specified.
            $table->string('info_link')->nullable(); //Link to a website with more info on the fish
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
