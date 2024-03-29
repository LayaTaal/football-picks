<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

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
                return view( 'components.league-picks',
            [
                'users' => User::all_current_first(),
            ]
        );
    }

}
