<?php

// Name: Vera Korchemnaya
// Description: Migration
//      This is the migration for the issues table.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('volume')->unsigned();
            $table->integer('issue_number')->unsigned();
            // Month and condition are both made to be integers
            // for easier sorting down the road.
            // Of course this means that there has to be conversions
            // when diplaying the data; there are trade offs
            $table->integer('month')->unsigned();
            $table->integer('year');
            $table->integer('condition')->unsigned();
            $table->string('writer_last_name');
            $table->string('writer_first_name');
            $table->string('artist_last_name');
            $table->string('artist_first_name');
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
        Schema::dropIfExists('issues');
    }
}
