<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function season() {
        return $this->belongsTo( Season::class );
    }

    public function games() {
        return $this->hasMany( Game::class );
    }

    public function has_started() {
        foreach ( $this->games as $game ) {
            if ( $game->is_over() )  {
                return true;
            }
        }

        return false;
    }

    public function all_in_progress() {
     return Round::all()
        ->where( 'season_id', config( 'settings.active_season'))
        ->filter( function( Round $round ) {
            return $round->has_started();
        });
    }

    public function is_complete() {
         foreach ( $this->games as $game ) {
            if ( ! $game->has_score() )  {
                return false;
            }
        }

        return true;
    }
}
