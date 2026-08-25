<?php

namespace App\Http\Controllers;

use App\Imports\GraduateImport;
use App\Models\GraduationSession;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function create(GraduationSession $session)
    {
        return view('imports.create', compact('session'));
    }

    public function store(Request $request, GraduationSession $session)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $import = new GraduateImport($session);
        Excel::import($import, $request->file('file'));

        return redirect()->route('sessions.graduates.index', $session)
            ->with('success', "{$import->success} data berhasil diimport.")
            ->with('failed', $import->failed);
    }
}
