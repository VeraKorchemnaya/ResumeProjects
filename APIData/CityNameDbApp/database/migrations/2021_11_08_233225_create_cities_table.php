<?php

/*  
Name: Vera Korchemnaya
Description: 
    This is the migration for our cities table.
    A city has a name, state, population in 2000, 
    population in 2010, and population in 2020.

*/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('state');
            $table->integer('population_2000');
            $table->integer('population_2010');
            $table->integer('population_2020');
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
        Schema::dropIfExists('cities');
    }
}
