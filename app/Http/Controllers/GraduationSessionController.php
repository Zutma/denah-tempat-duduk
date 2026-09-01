<?php

namespace App\Http\Controllers;

use App\Models\GraduationEvent;
use App\Models\GraduationSession;
use Illuminate\Http\Request;

class GraduationSessionController extends Controller
{
    public function index(GraduationEvent $graduationEvent)
    {
        $sessions = $graduationEvent->sessions;
        return view('sessions.index', compact('graduationEvent', 'sessions'));
    }

    public function create(GraduationEvent $graduationEvent)
    {
        return view('sessions.create', compact('graduationEvent'));
    }

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

    public function show(string $id)
    {
        //
    }

    public function edit(GraduationSession $session)
    {
        return view('sessions.edit', compact('session'));
    }

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

    public function destroy(GraduationSession $session)
    {
        $eventId = $session->graduation_event_id;
        $session->delete();
        return redirect()->route('graduation-events.sessions.index', $eventId)->with('success', 'Sesi berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'exists:graduation_sessions,id'
        ]);

        GraduationSession::whereIn('id', $request->ids)->delete();

        return redirect()->back()->with('success', count($request->ids) . ' sesi berhasil dihapus secara massal.');
    }
}