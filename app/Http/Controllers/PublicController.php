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
        // 1. Ambil semua sesi yang published
        $publishedSessions = GraduationSession::with('event')
            ->where('status', 'published')
            ->latest()
            ->get();

        // 2. Hanya set activeSession JIKA user sudah memilih di dropdown (ada session_id di URL)
        $sessionId = $request->input('session_id');
        $activeSession = $sessionId ? $publishedSessions->firstWhere('id', $sessionId) : null;

        $searchQuery = $request->input('search');
        $myInfo = null;
        $mySeatId = null;
        $leftRows = collect();
        $rightRows = collect();
        $message = null;

        // 3. Jika belum pilih sesi sama sekali
        if (!$activeSession) {
            $message = 'Silahkan pilih Acara Wisuda terlebih dahulu untuk melihat denah tempat duduk.';
        } else {
            // Logika pencarian mahasiswa...
            if ($searchQuery) {
                $myInfo = Graduate::with(['seat', 'faculty', 'studyProgram'])
                    ->where('graduation_session_id', $activeSession->id)
                    ->where(function($query) use ($searchQuery) {
                        $query->where('nrp', $searchQuery)
                            ->orWhere('name', 'LIKE', "%{$searchQuery}%");
                    })->first();

                if ($myInfo && $myInfo->seat) {
                    $mySeatId = $myInfo->seat->id;
                }
            }

            // Ambil denah kursi untuk sesi yang dipilih...
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
            'myInfo', 
            'mySeatId',
            'message'
        ));
    }

}
