<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function round() {
        return $this->belongsTo( Round::class );
    }

    public function user_pick() {
        return $this->hasOne( Pick::class )->where( 'user_id', Auth::id() ) ?? null;
    }
}
