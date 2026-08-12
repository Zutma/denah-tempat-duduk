<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\StudyProgram;
use Illuminate\Http\Request;

class StudyProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studyPrograms = StudyProgram::with('faculty')->get();
        return view('study-programs.index',compact('studyPrograms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculties = Faculty::all();
        return view('study-programs.create',compact('faculties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'faculty_id' => 'required|exists:faculties,id',
        'name' => 'required|string',
        'degree_level' => 'nullable|string',
        ]);

        StudyProgram::create($request->only(['faculty_id', 'name', 'degree_level']));

        return redirect()->route('study-programs.index');
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
    public function edit(Studyprogram $studyProgram)
    {
        $faculties = Faculty::all();
        return view('study-programs.edit', compact('studyProgram', 'faculties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudyProgram $studyProgram)
{
        $request->validate([
            'faculty_id' => 'required|exists:faculties,id',
            'name' => 'required|string',
            'degree_level' => 'nullable|string',
        ]);

        $studyProgram->update($request->only(['faculty_id', 'name', 'degree_level']));

        return redirect()->route('study-programs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudyProgram $studyProgram)
    {
        $studyProgram->delete();
        return redirect()->route('study-programs.index');
    }
}
