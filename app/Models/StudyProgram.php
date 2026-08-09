<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    protected $fillable = [
        'faculty_id',
        'name',
        'degree_level'
    ];

    public function faculty(){
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }
}
