<?php

namespace App\Http\Controllers;

use App\Models\GraduationEvent;
use Illuminate\Http\Request;

class GraduationEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = GraduationEvent::all();
        return view('graduation-events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('graduation-events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|string'
        ]);

        GraduationEvent::create($request->only(['name']));

        return redirect()->route('graduation-events.index');
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
    public function edit(GraduationEvent $graduationEvent)
    {
        return view('graduation-events.edit',compact('graduationEvent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GraduationEvent $graduationEvent)
    {
        $request->validate([
            'name'=>'required|string',
        ]);

        $graduationEvent->update($request->only(['name']));

        return redirect()->route('graduation-events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GraduationEvent $graduationEvent)
    {
        if ($graduationEvent->sessions()->exists()) {
            return redirect()->route('graduation-events.index')
                ->with('error', 'Tidak bisa menghapus event yang masih memiliki sesi. Hapus sesinya terlebih dahulu.');
        }

        $graduationEvent->delete();
        return redirect()->route('graduation-events.index');
    }
}
