<?php

namespace App\View\Components;

use App\Models\User;
use App\Models\Round;
use App\Models\Season;
use Illuminate\View\Component;

class SeasonStats extends Component {

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
        // todo: Could we actually return each item from this 2d array as a view, instead of having to loop through multiple times?

        return view( 'components.season-stats', [
            'stats' => $this->statsArray(),
        ] );
    }

    public function statsArray(): array {
        $settings = config( 'settings' );
        $users    = User::all_current_first();
        $rounds   = Round::where( 'season_id', $settings['active_season'] )->get();

        $season_stats = [];

        $header = [
            'Rounds'
        ];

        for ( $i = 0; $i < count( $users ); $i ++ ) {
            array_push( $header, $users[ $i ]->name );
        }

        $season_stats[] = $header;

        for ( $i = 0; $i < count( $rounds ); $i++ ) {
            $round = [];

            if ( $rounds->has( $i ) ) {
                if ( ! $rounds[ $i ]->is_complete() ) {
                    return $season_stats;
                }
            }

            for ( $j = 0; $j < count( $users ); $j++ ) {
                $user_picks    = $users[ $j ]->picks()->where( 'round_id', $rounds[ $i ]->id )->get();
                $correct_picks = 0;

                foreach ( $user_picks as $pick ) {
                    $winning_team = $pick->game->winning_team();

                    if ( $winning_team === $pick->team->id ) {
                        $correct_picks += 1;
                    }
                }

                $round[] = $correct_picks;
            }

            array_unshift( $round, $rounds[ $i ]->title );

            $season_stats[] = $round;
        }

        return $season_stats;
    }

}
