<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class SimpleUserStats extends Component {

    /**
     * Create a new component instance.
     *
     * @param  \App\Models\User  $user
     *
     * @return void
     */
    public function __construct(
        public User $user
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View {
        return view( 'components.simple-user-stats' );
    }

}
