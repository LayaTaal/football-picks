<?php

namespace App\View\Components\Picks;

use App\Models\Team;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Game extends Component {

    /**
     * @param                     $game
     * @param  \App\Models\Team   $team
     */
    public function __construct(
        public $game,
        public Team $team,
    ) {
//        dd( $game->user_pick->game_id );
    }

    public function render(): View {
        return view( 'components.picks.game' );
    }
}
