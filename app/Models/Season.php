<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function rounds() {
        return $this->hasMany( Round::class );
    }

    public function games() {
        return $this->hasMany( Game::class );
    }

    public function picks() {
        return $this->hasMany( Pick::class );
    }
}
