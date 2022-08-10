<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Pick;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardController extends Controller {

    public function index( Request $request ) {

        return view( '/dashboard', [
            'current_games' => Game::where( 'round_id', config( 'settings' )['active_round'] )->get(),
        ] );
    }

    public function update() {
        $games_data = request()->all();
        $games = $games_data['games'] ?? [];

        if ( ! $games ) {
            return back()->with( 'error', 'There are no games this week!' );
        }

        foreach ( $games as $game_id ) {
            $attributes = [
                'user_id'   => request()->user()->id,
                'game_id'   => (int) $game_id,
                'team_id'   => (int) $games_data[ 'game_' . $game_id ][0] ?? 0,
                'season_id' => config( 'settings' )['active_season'],
                'round_id'  => config( 'settings' )['active_round'],
            ];

            $pick = Pick::where( 'game_id', $game_id );

            if ( $pick->exists() ) {
                $pick->update( $attributes );
            } else {
                Pick::create( $attributes );
            }
        }

        return back()->with( 'success', 'Picks saved!' );
    }

}
