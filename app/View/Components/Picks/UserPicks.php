<?php

namespace App\View\Components\Picks;

use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class UserPicks extends Component {

    public Collection $games;

    public function __construct( $games ) {
        $this->games = $games;
    }

    public function render(): View {
        return view( 'components.picks.user-picks' );
    }

}
