<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class LeaguePicks extends Component {

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        $users = User::all()
             ->filter( function ( $user ) {
                 return $user->id !== Auth::user()->id;
             } )
             ->prepend( Auth::user() );

        return view( 'components.league-picks',
            [
                'users' => $users,
            ]
        );
    }

}
