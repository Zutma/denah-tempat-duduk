<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Graduate;
use App\Models\GraduationSession;
use App\Models\StudyProgram;
use Illuminate\Http\Request;

class GraduateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GraduationSession $session)
    {
        $graduates = Graduate::where('graduation_session_id',   $session->id)
            ->with(['faculty','studyProgram','seat'])
            ->get();

        return view('graduates.index',compact('session','graduates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(GraduationSession $session)
    {
        $faculties = Faculty::all();
        $studyPrograms = StudyProgram::all();

        return view('graduates.create',compact('session','faculties','studyPrograms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, GraduationSession $session)
    {
        $request->validate([
            'nrp' => 'required|string|regex:/^[0-9]+$/',
            'name' => 'required|string',
            'faculty_id' => 'required|exists:faculties,id',
            'study_program_id' => 'required|exists:study_programs,id',
        ]);

        Graduate::create([
            'graduation_session_id' => $session->id,
            'faculty_id' => $request->faculty_id,
            'study_program_id' => $request->study_program_id,
            'nrp' => $request->nrp,
            'name' => $request->name,
        ]);

        return redirect()->route('sessions.graduates.index', $session);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Graduate $graduate)
    {
        $sessionId = $graduate->graduation_session_id;
        $graduate->delete();
        return redirect()->route('sessions.graduates.index', $sessionId);
    }
}
