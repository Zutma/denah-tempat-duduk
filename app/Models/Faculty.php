<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = [
        'code',
        'name',
        'color'
    ];

    public function studyPrograms(){
        return $this->hasMany(StudyProgram::class, 'faculty_id');
    }

    public function graduates(){
        return $this->hasMany(Graduate::class, 'faculty_id');
    }
}
