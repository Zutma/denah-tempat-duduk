<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GraduationSession;
use App\Models\SeatRow;
use App\Models\Graduate;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $publishedSessions = GraduationSession::with('event')
            ->where('status', 'published')
            ->latest()
            ->get();

        $sessionId = $request->input('session_id');
        $activeSession = $sessionId ? $publishedSessions->firstWhere('id', $sessionId) : null;

        $searchQuery = $request->input('search');
        $searchResults = [];
        $leftRows = collect();
        $rightRows = collect();
        $message = null;

        if (!$activeSession) {
            $message = 'Silahkan pilih Acara Wisuda terlebih dahulu untuk melihat denah tempat duduk.';
        } else {
            // Logika Pencarian yang Benar (Mengambil Wisudawan yang Punya Kursi)
            if ($searchQuery) {
                $graduates = Graduate::with(['seat.seatRow', 'faculty', 'studyProgram'])
                    ->where('graduation_session_id', $activeSession->id)
                    ->where(function($q) use ($searchQuery) {
                        $q->where('nrp', 'LIKE', "%{$searchQuery}%")
                          ->orWhere('name', 'LIKE', "%{$searchQuery}%");
                    })
                    ->has('seat') // Memastikan wisudawan ini benar-benar punya kursi
                    ->get();

                foreach ($graduates as $g) {
                    if ($g->seat && $g->seat->seatRow) {
                        $searchResults[] = [
                            'seat_id' => $g->seat->id,
                            'seat_code' => $g->seat->seatRow->row . sprintf('%02d', $g->seat->number),
                            'name' => $g->name,
                            'nrp' => $g->nrp,
                            'prodi' => $g->studyProgram->name ?? '-',
                            'faculty' => $g->faculty->name ?? '-',
                            'color' => $g->faculty->color ?? '#cbd5e1'
                        ];
                    }
                }
            }

            // Denah Kursi Sayap Kiri dan Kanan
            $leftRows = SeatRow::with(['seats.graduate.faculty', 'seats.graduate.studyProgram'])
                ->where('graduation_session_id', $activeSession->id)
                ->where('side', 'left')
                ->orderBy('row')
                ->get();

            $rightRows = SeatRow::with(['seats.graduate.faculty', 'seats.graduate.studyProgram'])
                ->where('graduation_session_id', $activeSession->id)
                ->where('side', 'right')
                ->orderBy('row')
                ->get();
        }

        return view('welcome', compact(
            'publishedSessions',
            'activeSession', 
            'leftRows', 
            'rightRows', 
            'searchQuery', 
            'searchResults',
            'message'
        ));
    }
}