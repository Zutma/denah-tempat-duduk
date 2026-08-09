<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeatRow extends Model
{
    protected $fillable = [
        'graduation_session_id',
        'row',
        'side',
        'index',
        'capacity'
    ];

    public function session(){
        return $this->belongsTo(GraduationSession::class, 'graduation_session_id');
    }

    public function seats(){
        return $this->hasMany(Seat::class, 'seat_row_id');
    }
}
