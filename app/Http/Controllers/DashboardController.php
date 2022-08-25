<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Pick;
use App\Models\Team;
use App\Models\Round;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardController extends Controller {

    public function index( Request $request ) {
        $settings = config( 'settings' );

        $current_games = Game::where( 'round_id', $settings['active_round'] )->get();

        $sorted_games = $current_games->sortBy( 'date' );

        $sorted_games->values()->all();

        return view( '/dashboard', [
            'current_games' => $sorted_games,
            'active_round'  => Round::findOrFail( $settings['active_round'] ),
            'active_season' => Season::findOrFail( $settings['active_season'] ),
        ] );
    }

    public function update() {
        $games_data = request()->all();
        $games      = $games_data['games'] ?? [];

        if ( ! $games ) {
            return back()->with( 'error', 'There are no games this week!' );
        }

        foreach ( $games as $game_id ) {
            $game_key = 'game_' . $game_id;

            if ( Game::findOrFail( $game_id )->is_over() ) {
                continue;
            }

            if ( ! array_key_exists( $game_key, $games_data ) ) {
                continue;
            }

            $attributes = [
                'user_id'   => request()->user()->id,
                'game_id'   => (int) $game_id,
                'team_id'   => (int) $games_data[ $game_key ][0] ?? 0,
                'season_id' => config( 'settings' )['active_season'],
                'round_id'  => config( 'settings' )['active_round'],
            ];

            $pick = Pick::where( 'game_id', $game_id )->where( 'user_id', request()->user()->id );

            if ( $pick->exists() ) {
                $pick->update( $attributes );
            } else {
                $pick->insert( $attributes );
            }
        }

        return back()->with( 'success', 'Picks saved!' );
    }

}
