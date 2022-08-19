<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function rounds() {
        return Round::where( 'season_id', $this->id );
    }

    public function games() {
        return Game::where( 'season_id', $this->id );
    }

    public function picks() {
        return Pick::where( 'season_id', $this->id );
    }
}
