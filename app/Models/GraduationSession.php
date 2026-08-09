<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GraduationSession extends Model
{
    protected $fillable = [
        'graduation_event_id',
        'date',
        'session',
        'status'
    ];

    public function event(){
        return $this->belongsTo(GraduationEvent::class, 'graduation_event_id');
    }

    public function seatRows(){
        return $this->hasMany(SeatRow::class, 'graduation_session_id');
    }

    public function graduates(){
        return $this->hasMany(Graduate::class, 'graduation_session_id');
    }
}
