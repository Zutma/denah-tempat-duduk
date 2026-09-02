<?php

namespace App\Http\Controllers;

use App\Models\GraduationSession;
use App\Models\Seat;
use App\Models\SeatRow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeatRowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GraduationSession $session)
    {
        $seatRows =SeatRow::where('graduation_session_id', $session->id)
            ->with('seats')
            ->orderBy('row')
            ->get();

        $allLetters = range('A', 'Z');
        $usedLetters = $seatRows->pluck('row')->toArray();

        return view('seat-rows.index', compact('session', 'seatRows','allLetters','usedLetters'));
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
            'rows' => 'required|array|min:1',
            'rows.*.row' => 'required|string|max:1',
            'rows.*.left_capacity' => 'required|integer|min:0|max:100',
            'rows.*.right_capacity' => 'required|integer|min:0|max:100',
        ]);

        $createdCount = 0;
        $skippedCount = 0;

        DB::transaction(function () use ($request, $session, &$createdCount, &$skippedCount) {
            foreach ($request->rows as $rowData) {
                $rowName = strtoupper($rowData['row']);

                // Process Sisi Kiri
                if ($rowData['left_capacity'] > 0) {
                    $this->createSeatRowWithSeats($session->id, $rowName, 'left', $rowData['left_capacity'], $createdCount, $skippedCount);
                }

                // Process Sisi Kanan
                if ($rowData['right_capacity'] > 0) {
                    $this->createSeatRowWithSeats($session->id, $rowName, 'right', $rowData['right_capacity'], $createdCount, $skippedCount);
                }
            }
        });

        $message = "Berhasil memproses baris kursi. ({$createdCount} sisi dibuat";
        if ($skippedCount > 0) {
            $message .= ", {$skippedCount} sisi dilewati karena sudah ada";
        }
        $message .= ").";

        return redirect()->route('sessions.seats.index', $session)->with('success', $message);
    }

    private function createSeatRowWithSeats($sessionId, $row, $side, $capacity, &$createdCount, &$skippedCount)
    {
        $exists = SeatRow::where('graduation_session_id', $sessionId)
            ->where('row', $row)
            ->where('side', $side)
            ->exists();

        if ($exists) {
            $skippedCount++;
            return;
        }

        $seatRow = SeatRow::create([
            'graduation_session_id' => $sessionId,
            'row' => $row,
            'side' => $side,
            'index' => 0,
            'capacity' => $capacity,
        ]);

        $seatsData = [];
        for ($i = 1; $i <= $capacity; $i++) {
            $seatsData[] = [
                'seat_row_id' => $seatRow->id,
                'position' => $i,
                'number' => $i,
                'category' => 'regular',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Seat::insert($seatsData);
        $createdCount++;
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
