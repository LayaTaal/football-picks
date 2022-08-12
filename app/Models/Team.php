<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model {

    use HasFactory;

    protected $guarded = [];

    public function get_current_game(): Game {
        $settings = config( 'settings' );

        // todo: there is a potential problem here and games should store the season they are from as well
        $game = Game::where( 'away_team', $this->id )
                   ->orWhere( 'home_team', $this->id )
                   ->where( 'round_id', $settings['active_round'] )->get();

        return $game[0];
    }

    public function score(): int {
        $current_game = $this->get_current_game();

        if ( $current_game->home_team === $this->id ) {
            return $current_game->home_team_score ?? 0;
        } else {
            return $current_game->away_team_score ?? 0;
        }
    }

}
