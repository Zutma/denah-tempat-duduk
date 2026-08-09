<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GraduationEvent extends Model
{
    protected $fillable = ['name'];

    public function sessions(){
        return $this->hasMany(GraduationSession::class, 'graduation_event_id');
    }

    
}
