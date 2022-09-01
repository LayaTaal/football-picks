<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survivor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->hasOne( User::class );
    }

    public function team() {
        return $this->hasOne( Team::class );
    }

    public function game() {
        return $this->hasOne( Game::class );
    }

    public function season() {
        return $this->hasOne( Season::class );
    }

    public function round() {
        return $this->hasOne( Round::class );
    }
}
