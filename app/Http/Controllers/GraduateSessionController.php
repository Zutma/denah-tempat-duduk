<?php

namespace App\Http\Controllers;

use App\Models\GraduationEvent;
use Illuminate\Http\Request;

class GraduateSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GraduationEvent $graduationEvent)
    {
        $sessions = $graduationEvent->sessions;
        return view('sessions.index', compact('graduationEvent', 'sessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(GraduationEvent $graduationEvent)
    {
        return view('sessions.create', compact('graduationEvent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, GraduationEvent $graduationEvent)
    {
        $request->validate([
        'date' => 'required|date',
        'session' => 'nullable|integer',
        'status' => 'required|in:draft,published,archived',
    ]);

    $graduationEvent->sessions()->create($request->only(['date', 'session', 'status']));

    return redirect()->route('graduation-events.sessions.index', $graduationEvent);
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
    public function edit(GraduationSession $session)
    {
        return view('sessions.edit', compact('session'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GraduationSession $session)
    {
        $request->validate([
        'date' => 'required|date',
        'session' => 'nullable|integer',
        'status' => 'required|in:draft,published,archived',
    ]);

    $session->update($request->only(['date', 'session', 'status']));

    return redirect()->route('graduation-events.sessions.index', $session->graduation_event_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GraduationSession $session)
    {
        $eventId = $session->graduation_events_id;
        $session->delete();
        return redirect()->route('graduation-events.sessions.index', $eventId);
    }
}
