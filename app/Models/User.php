<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function all_current_first() {
        return User::all()
                   ->filter( function ( $user ) {
                       return $user->id !== Auth::user()->id;
                   } )
                   ->prepend( Auth::user() );
    }

    public function picks() {
        return $this->hasMany( Pick::class );
    }

    public function picks_this_week() {
        return $this->hasMany( Pick::class )
                    ->where( 'season_id', config( 'settings' )['active_season'] )
                    ->where( 'round_id', config( 'settings' )['active_round'] )
                    ->orderBy( 'team_id' );
    }

    public function survivor_picks() {
        return $this->hasMany( Survivor::class )
                    ->where( 'season_id', config( 'settings' )['active_season'] );
    }

    public function survivor_pick_this_week() {
        return $this->hasOne( Survivor::class )
                    ->where( 'round_id', config( 'settings' )['active_round'] )
                    ->where( 'season_id', config( 'settings' )['active_season'] );
    }

    /**
     * Get the users status in survivor. This will return an int which indicates their status.
     *
     * 2 = still 2 tries remaining
     * 1 = 1 try left
     * 0  = eliminated
     */
    public function survivor_status() {
        // Start user with 2 points
        $points = 2;

        // Get all rounds that have started
        $rounds = ( new Round )->all_in_progress();

        foreach ( $rounds as $round ) {
            if ( $points === 0 ) {
                break;
            }

            $survivor_pick = $this->survivor_picks()->where( 'round_id', $round->id )->first();

            // Check if the current user has made a pick in that round
            if ( ! $survivor_pick ) {
                $points = $points - 1;
                continue;
            }

            $game = Game::find( $survivor_pick->game_id );

            // Don't calculate for games that aren't over yet
            if ( ! $game->has_score() ) {
                continue;
            }

            // Don't deduct for games that ended in a tie
            if ( $game->tie_score() ) {
                continue;
            }

            // Check if their pick won or lost
            $winning_team = $game->winning_team();

            if ( $survivor_pick->team_id !== $winning_team ) {
                $points = $points - 1;
            }
        }

        return $points;
    }

}
