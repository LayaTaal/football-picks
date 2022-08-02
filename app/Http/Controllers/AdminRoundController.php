<?php

namespace App\Http\Controllers;

use App\Models\Round;
use App\Models\Season;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminRoundController extends Controller {

    public function index() {
        return view( 'admin.rounds.index', [
            'rounds' => Round::all(),
        ] );
    }

    public function show( Round $round ) {
        dd( $round->games );

        return view( 'admin.rounds.show', [
            'round' => $round,
            'games' => $round->games,
        ] );
    }

    public function create() {
        return view( 'admin.rounds.create', [ 'seasons' => Season::all() ] );
    }

    public function store() {
        $attributes = request()->validate( [
            'title'      => [ 'required', Rule::unique( 'rounds', 'title' ) ],
            'season_id'  => [ 'required', Rule::exists( 'seasons', 'id' ) ],
            'start_date' => 'required',
            'end_date'   => 'required',
        ] );

        $attributes['slug'] = Str::slug( $attributes['title']);

        Round::create( $attributes );

        return redirect( '/admin/seasons/' . $attributes[ 'season_id' ] )->with( 'success', 'Round created successfully.' );
    }

    public function edit( Round $round ) {
        return view( 'admin.rounds.edit', [ 'round' => $round, 'seasons' => Season::all() ] );
    }

    public function update( Round $round ) {
        $attributes = request()->validate( [
            'title'     => [ 'required', Rule::unique( 'rounds', 'title' )->ignore( $round ) ],
            'season_id' => [ 'required', Rule::exists( 'seasons', 'id' ) ],
        ] );

        $round->update( $attributes );

        return redirect( '/admin/seasons/' . $attributes[ 'season_id' ] )->with( 'success', 'Round updated successfully.' );
    }

    public function destroy( Round $round ) {
        $round->delete();

        return back()->with( 'success', 'Round deleted successfully.' );
    }

}
