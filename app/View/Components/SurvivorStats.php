<?php

namespace App\View\Components;

use App\Models\Game;
use App\Models\Round;
use App\Models\Team;
use App\Models\User;
use Illuminate\View\Component;

class SurvivorStats extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.survivor-stats', [
            'table' => $this->create_table(),
        ]);
    }

    private function create_table(): array {
        $rounds = Round::all()->filter( function( $round ) {
            return $round->is_complete();
        } );

        $users = User::all_current_first();

        $table = [];

        // Setup our header row
        $header = [
            'Rounds'
        ];

        // Loop through all users and append to header row
        for ( $i = 0; $i < count( $users ); $i ++ ) {
            array_push( $header, $users[ $i ] );
        }

        array_push( $table, $header );

        for ( $i = 0; $i < count( $rounds ); $i++ ) {
            $row = [ $rounds[ $i ]->title ];

            for ( $j = 0; $j < count( $users ); $j++ ) {
                $survivor_pick = $users[ $j ]->survivor_picks()->where( 'round_id', $rounds[$i]->id)->first();

                if ( ! $survivor_pick ) {
                    array_push( $row, null );

                    continue;
                }

                $team = Team::find( $survivor_pick->team_id );
                $game = Game::where( 'round_id', $rounds[$i]->id )
                    ->where( 'season_id', config('settings.active_season' ) )
                    ->where( function( $query ) use ( $team ) {
                        $query->where( 'home_team', $team->id )
                        ->orWhere( 'away_team', $team->id );
                    })
                    ->first();

                array_push( $row, [
                    'team' => $team,
                    'team_won' => $game->winning_team() === $survivor_pick->team_id || $game->tie_score(),
                ] );
            }

            array_push( $table, $row );
        }

        return $table;
    }
}
