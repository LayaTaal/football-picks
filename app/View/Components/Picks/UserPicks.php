<?php

namespace App\View\Components\Picks;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class UserPicks extends Component {

    public function __construct( public $games ) {
    }

    public function render(): View {
        return view( 'components.picks.user-picks' );
    }

}
