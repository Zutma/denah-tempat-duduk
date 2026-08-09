<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable = [
        'seat_row_id',
        'position',
        'number',
        'category'
    ];

    public function seatRow(){
        return $this->belongsTo(SeatRow::class, 'seat_row_id');
    }

    public function graduate(){
        return $this->hasOne(Graduate::class, 'seat_id');
    }
}
