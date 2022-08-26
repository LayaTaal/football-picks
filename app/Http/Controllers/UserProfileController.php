<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller {

    public function index() {
        return view( 'user-profile' );
    }

    public function update() {
        $request = request()->all();

        $attributes = request()->validate( [
            'name'     => 'string',
            'email'    => Rule::unique( 'users', 'email' )->ignore( auth()->user()->id ),
            'password' => 'min:8',
        ] );

        if ( $attributes[ 'password' ] !== auth()->user()->password ) {
            $attributes[ 'password' ] = Hash::make( $attributes[ 'password' ] );
        }

        auth()->user()->update( $attributes );

        return back()->with( 'success', 'profile updated' );
    }

}
