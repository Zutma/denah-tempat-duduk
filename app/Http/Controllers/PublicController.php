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
        // 1. Ambil sesi wisuda yang aktif (contoh ambil sesi pertama)
        // Nanti lu bisa tambahin kolom status (aktif/tidak) di tabel graduation_sessions
        $activeSession = GraduationSession::latest()->first();

        if (!$activeSession) {
            return view('welcome', ['message' => 'Belum ada jadwal wisuda.']);
        }

        // 2. Logika Pencarian (Jika ada input nama/nrp)
        $searchQuery = $request->input('search');
        $myInfo = null;
        $mySeatId = null;

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

        // 3. Ambil data baris kursi untuk Sayap Kiri dan Sayap Kanan
        // Load juga relasi seats dan graduate-nya sekaligus
        $leftRows = SeatRow::with(['seats.graduate.faculty'])
            ->where('graduation_session_id', $activeSession->id)
            ->where('side', 'left')
            ->orderBy('row') // Urut A, B, C...
            ->get();

        $rightRows = SeatRow::with(['seats.graduate.faculty'])
            ->where('graduation_session_id', $activeSession->id)
            ->where('side', 'right')
            ->orderBy('row')
            ->get();

        // 4. Kirim data ke tampilan welcome.blade.php
        return view('welcome', compact('activeSession', 'leftRows', 'rightRows', 'searchQuery', 'myInfo', 'mySeatId'));
    }
}