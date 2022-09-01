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
        return $this->hasOne( Survivor::class )
            ->where( 'season_id', config( 'settings' )['active_season'] )
            ->where( 'round_id', config( 'settings' )['active_round'] );
    }

}
