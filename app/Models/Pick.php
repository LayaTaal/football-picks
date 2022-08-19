<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pick extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function season() {
        return Season::findOrFail( $this->season_id );
    }

    public function round() {
        return Round::findOrFail( $this->round_id );
    }

    public function user() {
        return $this->belongsTo( User::class );
    }

    public function game() {
        return Game::findOrFail( $this->game_id );
    }

    public function team() {
        return Team::findOrFail( $this->team_id );
    }
}
