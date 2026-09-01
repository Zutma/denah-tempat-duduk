<?php

namespace App\Http\Controllers;

use App\Models\GraduationEvent;
use Illuminate\Http\Request;

class GraduationEventController extends Controller
{
    public function index()
    {
        $events = GraduationEvent::all();
        return view('graduation-events.index', compact('events'));
    }

    public function create()
    {
        return view('graduation-events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|string'
        ]);

        GraduationEvent::create($request->only(['name']));

        return redirect()->route('graduation-events.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(GraduationEvent $graduationEvent)
    {
        return view('graduation-events.edit',compact('graduationEvent'));
    }

    public function update(Request $request, GraduationEvent $graduationEvent)
    {
        $request->validate([
            'name'=>'required|string',
        ]);

        $graduationEvent->update($request->only(['name']));

        return redirect()->route('graduation-events.index');
    }

    public function destroy(GraduationEvent $graduationEvent)
    {
        $graduationEvent->delete();
        return redirect()->route('graduation-events.index')->with('success', 'Event berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'exists:graduation_events,id'
        ]);

        GraduationEvent::whereIn('id', $request->ids)->delete();

        return redirect()->route('graduation-events.index')->with('success', count($request->ids) . ' event berhasil dihapus secara massal.');
    }
}