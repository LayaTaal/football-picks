<?php

namespace App\View\Components;

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

        $users = User::all();

        $table = [];

        $header = [
            'Rounds'
        ];

        for ( $i = 0; $i < count( $users ); $i ++ ) {
            array_push( $header, $users[ $i ]->name );
        }

        array_push( $table, $header );

        for ( $i = 0; $i < count( $rounds ); $i++ ) {
            $row = [ $rounds[ $i ]->title ];

            for ( $j = 0; $j < count( $users ); $j++ ) {
                $survivor_pick = $users[ $j ]->survivor_picks()->where( 'round_id', $rounds[$i]->id)->first();
                $team = Team::find( $survivor_pick->id );

                array_push( $row, $team );
            }

            array_push( $table, $row );
        }

        return $table;
    }
}
