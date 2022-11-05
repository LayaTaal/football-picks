<?php

namespace App\Models;

use DateTime;
use DateTimeZone;
use DateInterval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model {

    use HasFactory;

    protected $guarded = [];

    public function round() {
        return $this->belongsTo( Round::class );
    }

    public function picks() {
        return $this->hasMany( Pick::class );
    }

    public function survivors() {
        return $this->hasMany( Survivor::class );
    }

    public function user_pick() {
        $pick = $this->hasOne( Pick::class )->where( 'user_id', Auth::id() );

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
        $game_date    = new DateTime( $this->date, new DateTimeZone( 'UTC' ) );
        $game_date->setTimeZone( new DateTimeZone( 'America/New_York' ) );

        // todo: look into better way to handle this in the future
        $utc_to_eastern = config( 'settings.daylight_savings_time' ) === 1 ? "PT4H" : "PT5H";
        $revised_game_date = ( clone $game_date )->add( new DateInterval( $utc_to_eastern ) );

        return $current_date >= $revised_game_date;
    }

    public function has_score(): bool {
        return $this->home_team_score || $this->away_team_score;
    }

    public function home_team_won(): ?bool {
        if ( $this->home_team_score > $this->away_team_score ) {
            return true;
        } elseif ( $this->home_team_score < $this->away_team_score ) {
            return false;
        }

        // Case: tie
        return null;
    }

    public function winning_team() {
        if ( $this->home_team_score > $this->away_team_score ) {
            return $this->home_team;
        } elseif ( $this->home_team_score < $this->away_team_score ) {
            return $this->away_team;
        }

        return null;
    }

    public function tie_score() {
        if ( ! $this->home_team_score && ! $this->away_team_score ) {
            return false;
        }

        if ( $this->home_team_score === $this->away_team_score ) {
            return true;
        }

        return false;
    }

}
