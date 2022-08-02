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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId( 'away_team' )->constrained( 'teams' );
            $table->foreignId( 'home_team' )->constrained( 'teams' );
            $table->foreignId( 'round_id' );
            $table->dateTimeTz( 'date' );
            $table->integer( 'home_team_score' )->nullable();
            $table->integer( 'away_team_score')->nullable();
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
        Schema::dropIfExists('games');
    }
};
