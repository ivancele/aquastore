<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAquariumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aquariums', function (Blueprint $table) {
            $table->id();
            $table->string('glass_type');
            $table->double('size'); //In litres
            $table->string('shape');
            $table->boolean('has_water')->default(true); //If it doesn't have water then do not allow any fish to be kept here
            $table->integer('max_capacity')->default(0); //Zero for no limit
            $table->double('temperature')->nullable(); //Some fish require certain temperature to survive this could be used as a validation method
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
        Schema::dropIfExists('aquariums');
    }
}
