<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pick extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function season() {
        return $this->belongsTo( Season::class );
    }

    public function round() {
        return $this->belongsTo( Round::class );
    }

    public function user() {
        return $this->belongsTo( User::class );
    }

    public function game() {
        return $this->belongsTo( Game::class );
    }

    public function team() {
        return $this->belongsTo( Team::class );
    }

    public function is_correct() {
        return $this->game->winning_team() === $this->team->id;
    }
}
