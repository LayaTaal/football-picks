<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminTeamController extends Controller
{
    public function index() {
        return view( 'admin.teams.index', [ 'teams' => Team::all() ] );
    }

    public function create() {
        return view( 'admin.teams.create' );
    }

    public function store() {
        $attributes = request()->all();
        $attributes[ 'slug' ] = Str::slug( $attributes[ 'name' ] );

        Team::create( $attributes );

        return redirect( 'admin/teams' )->with( 'success', 'Team created successfully.' );
    }

    public function edit( Team $team ) {
        return view( 'admin.teams.edit', [ 'team' => $team ] );
    }

    public function update( Team $team ) {
        $attributes = request()->validate( [
            'name' => [ Rule::unique( 'teams', 'name' )->ignore( $team ) ],
        ] );

        $attributes[ 'slug' ] = Str::slug( $attributes[ 'name' ] );

        $team->update( $attributes );

        return redirect( 'admin/teams' )->with( 'success', 'Team updated successfully.' );
    }

    public function destroy( Team $team ) {
        $team->delete();

        return back()->with( 'success', 'Team deleted successfully.' );
    }
}
