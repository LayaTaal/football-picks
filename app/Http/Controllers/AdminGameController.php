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
}
