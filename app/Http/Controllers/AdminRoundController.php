<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminRoundController extends Controller {

    public function create() {
        return view( 'admin.rounds.create' );
    }

    public function store() {
        dd( request()->all() );
    }

}
