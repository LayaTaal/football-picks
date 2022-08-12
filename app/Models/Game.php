<?php

namespace App\Models;

use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model {

    use HasFactory;

    protected $guarded = [];

    public function round() {
        return $this->belongsTo( Round::class );
    }

    public function user_pick() {
        return $this->hasOne( Pick::class )->where( 'user_id', Auth::id() ) ?? null;
    }

    public function formatted_date() {
        return date( "F j, Y", strtotime( $this->date ) );
    }

    public function formatted_time() {
        return date( "g:i a", strtotime( $this->date ) );
    }

    public function is_over(): bool {
        $current_date = new DateTime( 'now', new DateTimeZone( 'America/New_York' ) );
        $game_date    = new DateTime( $this->date, new DateTimeZone( 'America/New_York' ) );

        return $current_date >= $game_date;
    }

    public function has_score(): bool {
        return $this->home_team_score && $this->away_team_score;
    }

    public function winning_team(): ?Team {
        if ( $this->home_team_score > $this->away_team_score ) {
            return Team::findOrFail( $this->home_team );
        } else if ( $this->home_team_score < $this->away_team_score ){
            return Team::findOrFail( $this->away_team );
        }

        // Case: tie
        return null;
    }
}
