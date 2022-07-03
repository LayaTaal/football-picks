<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminSeasonController extends Controller
{
    public function index() {
        return view( 'admin.seasons.index', [
            'seasons' => Season::all(),
        ] );
    }

    public function show( Season $season ) {
        return view( 'admin.seasons.show', [
            'season' => $season
        ] );
    }

    public function create() {
        return view( 'admin.seasons.create' );
    }

    public function store() {
        $attributes = request()->validate( [
            'title' => [ 'required', Rule::unique( 'seasons', 'title' ) ],
        ] );

        Season::create( $attributes );

        return redirect( '/admin/seasons/' )->with( 'success', 'Season created successfully.' );
    }

    public function edit( Season $season ) {
        return view( 'admin.seasons.edit',  [ 'season' => $season ] );
    }

    public function update( Season $season ) {
        $attributes = request()->validate( [
            'title' => [ 'required', Rule::unique( 'seasons', 'title' )->ignore( $season ) ],
        ] );

        $season->update( $attributes );

        return redirect( '/admin/seasons/' )->with( 'success', 'Season updated successfully.' );
    }

    public function destroy( Season $season ) {
        $season->delete();

        return back()->with( 'success', 'Season deleted successfully.' );
    }
}
