<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Graduate extends Model
{
    protected $fillable = [
        'graduation_session_id',
        'faculty_id',
        'study_program_id',
        'nrp',
        'name',
        'seat_id'
    ];

    public function session(){
        return $this->belongsTo(GraduationSession::class, "graduation_session_id");
    }
    public function faculty(){
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }
    public function studyProgram(){
        return $this->belongsTo(StudyProgram::class, 'study_program_id');
    }
    public function seat(){
        return $this->belongsTo(Seat::class, 'seat_id');
    }
}
