<?php

namespace App\View\Components\Picks;

use App\Models\Team;
use App\Models\Round;
use App\Models\Game;
use Illuminate\View\Component;

class SurvivorPicks extends Component {

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct() {
    }

    public function render() {
        // Get all teams
        $teams = Team::all()->filter( function( $team ) {
            $exists_as_away_team = Game::where( 'away_team', $team->id )
                ->where( 'round_id', config('settings.active_round' ) )
                ->where( 'season_id', config('settings.active_season' ) )
                ->exists();

            $exists_as_home_team = Game::where( 'home_team', $team->id )
                ->where( 'round_id', config('settings.active_round' ) )
                ->where( 'season_id', config('settings.active_season' ) )
                ->exists();

            return $exists_as_away_team || $exists_as_home_team;
        });

        // Get all survivor picks for current user in this season
        $user_survivor_stats = auth()->user()->survivor_status();
        $user_picks      = auth()->user()->survivor_picks()->get();
        $this_weeks_pick = 0;
        $teams_already_picked = [];

        foreach ( $user_picks as $pick ) {
            if ( $pick->round_id !== config( 'settings' )['active_round'] ) {
                $teams_already_picked[] = $pick->team_id;
            } else {
                $this_weeks_pick = $pick->team_id;
            }
        }

        // Remove teams already picked from teams array
        $available_teams = $teams->filter( function ( $team ) use ( $teams_already_picked ) {
            return ! in_array( $team->id, $teams_already_picked );
        } );

        return view( 'components.picks.survivor-picks', [
            'teams'           => $available_teams,
            'user_picks'      => $user_picks,
            'this_weeks_pick' => $this_weeks_pick,
            'previous_picks'  => $teams_already_picked,
            'round_started'   => Round::find( config( 'settings' )['active_round'] )->has_started(),
            'survivor_status' => auth()->user()->survivor_status(),
        ] );
    }

}
