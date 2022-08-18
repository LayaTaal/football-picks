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
        $pick = $this->hasone( Pick::class )->where( 'user_id', Auth::id() );

        if ( ! $pick ) {
            return [];
        }

        return $pick;
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

    public function home_team_won(): ?bool {
        if ( $this->home_team_score > $this->away_team_score ) {
            return true;
        } else if ( $this->home_team_score < $this->away_team_score ){
            return false;
        }

        // Case: tie
        return null;
    }

    public function winning_team() {
        if ( $this->home_team_score > $this->away_team_score ) {
            return $this->home_team;
        } else if ( $this->home_team_score < $this->away_team_score ){
            return $this->away_team;
        }

        return null;
    }
}
