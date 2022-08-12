<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pick extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo( User::class );
    }
//
//    public function pickByGame( Game $game ) {
//        return $this->where( 'user_id', 1 )->where( 'round_id', 1 )->get();
//    }

    public function is_correct() {
        // return true if the winning team was picked
    }
}
