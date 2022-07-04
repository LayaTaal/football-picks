<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Http\Request;

class AdminGameController extends Controller
{
    public function index() {
        return view( 'admin.games.index', [ 'games' => Game::all() ] );
    }

    public function create() {
        return view( 'admin.games.create', [ 'teams' => Team::all() ] );
    }
}
