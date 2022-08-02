<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Round;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminGameController extends Controller {

    public function index() {
        return view( 'admin.games.index', [ 'games' => Game::all() ] );
    }

    public function create() {
        return view( 'admin.games.create', [
            'teams'          => Team::all(),
            'selected_round' => request()->get( 'round' ),
            'rounds'         => Round::all(),
        ] );
    }

    public function store() {
        $attributes = request()->validate( [
            'away_team' => [ 'required', Rule::exists( 'teams', 'id' ) ],
            'home_team' => [ 'required', Rule::exists( 'teams', 'id' ) ],
            'round_id'  => Rule::exists( 'rounds', 'id' ),
            'date'      => [ 'required' ],
        ] );

        Game::create( $attributes );

        return redirect( '/admin/games' )->with( 'success', 'Game created successfully.' );
    }

    public function edit( Game $game ) {
        return view( 'admin.games.edit', [
            'game'   => $game,
            'teams'  => Team::all(),
            'rounds' => Round::all(),
        ] );
    }

    public function update( Game $game ) {
        $attributes = request()->validate( [
            'away_team' => [ 'required', Rule::exists( 'teams', 'id' ) ],
            'home_team' => [ 'required', Rule::exists( 'teams', 'id' ) ],
            'round_id'  => Rule::exists( 'rounds', 'id' ),
            'date'      => [ 'required' ],
        ] );

        if ( $home_team_score = request()->get( 'home_team_score') ) {
            $attributes[ 'home_team_score' ] = $home_team_score;
        }

        if ( $away_team_score = request()->get( 'away_team_score') ) {
            $attributes[ 'away_team_score' ] = $away_team_score;
        }

        $game->update( $attributes );

        return redirect( '/admin/games/' )->with( 'success', 'Game updated successfully.' );
    }

}
