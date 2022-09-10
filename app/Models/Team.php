<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model {

    use HasFactory;

    protected $guarded = [];

    public function get_current_game(): Game|null {
        $settings = config( 'settings' );

        $game = Game::where( 'round_id', $settings['active_round'] )
                    ->where( 'season_id', $settings['active_round'] )
                    ->orWhere( 'away_team', $this->id )
                    ->orWhere( 'home_team', $this->id );

        if ( ! $game->exists() ) {
            return null;
        }

        return $game->get()[0];
    }

    public function score( Game $game = null ): int|null {
        $current_game = $game ?: $this->get_current_game();

        if ( $current_game->home_team === $this->id ) {
            return $current_game->home_team_score ?? 0;
        } else {
            return $current_game->away_team_score ?? 0;
        }
    }

}
