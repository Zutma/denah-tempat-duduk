<?php

namespace App\Http\Controllers;

use App\Models\GraduationSession;
use App\Models\Seat;
use App\Models\SeatRow;
use Illuminate\Http\Request;

class SeatRowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GraduationSession $session)
    {
        $seatRows =SeatRow::where('graduation_session_id', $session->id)
            ->with('seats')
            ->get();

        return view('seat-rows.index', compact('session', 'seatRows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, GraduationSession $session)
    {
        $request->validate([
            'row'=>'required|string|max:1',
            'side'=>'required|in:left,right',
            'capacity'=>'required|integer|min:1|max:100'
        ]);

        $row = strtoupper($request->row);

        $exists = SeatRow::where('graduation_session_id', $session->id)
        ->where('row', $row)
        ->where('side', $request->side)
        ->exists();

        if ($exists) {
        return back()->withErrors(['row' => "Baris {$row} sisi {$request->side} sudah ada untuk sesi ini."])->withInput();
         }

        $seatRow = SeatRow::create([
            'graduation_session_id'=>$session->id,
            'row'=>$row,
            'side'=>$request->side,
            'index'=> 0,
            'capacity'=>$request->capacity,
        ]);

        for ($i = 1;$i <= $request->capacity;$i++){
            Seat::create([
                'seat_row_id'=> $seatRow->id,
                'position'=> $i,
                'number'=>$i,
                'category'=>'regular',
            ]);
        }

        return redirect()->route('sessions.seats.index', $session);
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
    public function destroy(SeatRow $seatRow)
    {
        $sessionId = $seatRow->graduation_session_id;
        $seatRow->delete();
        return redirect()->route('sessions.seats.index', $sessionId);
    }
}
