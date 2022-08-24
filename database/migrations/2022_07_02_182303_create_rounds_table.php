<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rounds', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Round Name
            $table->string('slug')->unique();// Slug
            $table->date( 'start_date' )->nullable(); // Start Date
            $table->date( 'end_date' )->nullable(); // End Date
            $table->foreignId( 'season_id' )->nullable(); // Season to associate with
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
        Schema::dropIfExists('rounds');
    }
};
