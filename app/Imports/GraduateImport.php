<?php

namespace App\Imports;

use App\Models\Faculty;
use App\Models\Graduate;
use App\Models\Seat;
use App\Models\SeatRow;
use App\Models\StudyProgram;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GraduateImport implements ToCollection, WithHeadingRow
{
    protected $session;
    public $success = 0;
    public $failed = [];

    public function __construct($session)
    {
        $this->session = $session;
    }

    public function collection(\Illuminate\Support\Collection $rows):void
    {
        foreach ($rows as $index => $row) {
            $baris = strtoupper(trim($row['kursi'] ?? ''));
            $sisi = strtolower(trim($row['sisi'] ?? '')) == 'kiri' ? 'left' : 'right';
            $nomor = $row['nomor'] ?? null;
            $nrp = (string) ($row['nrp'] ?? '');
            $nama = $row['nama'] ?? '';
            $fakultasKode = trim($row['fakultas'] ?? '');
            $prodiNama = trim($row['prodi'] ?? '');
            $jenjang = strtoupper(trim($row['jenjang'] ?? ''));

            if (!$nrp || !$nama || !$nomor){
                $this->failed[] = "Baris Excel " . ($index + 2) . ": data tidak lengkap.";
                continue;
            }

            $faculty = Faculty::firstOrCreate(['code' => $fakultasKode]);

            $studyProgram = StudyProgram::firstOrCreate([
                'faculty_id' => $faculty->id,
                'name' => $prodiNama,
                'degree_level' => $jenjang,
            ]);

            $seatRow = SeatRow::where('graduation_session_id', $this->session->id)
                ->where('row', $baris)
                ->where('side', $sisi)
                ->first();

            if (!$seatRow) {
                $this->failed[] = "Baris Excel " . ($index + 2) . ": kursi {$baris} sisi {$sisi} belum dibuat di Kelola Kursi.";
                continue;
            }

            $seat = Seat::where('seat_row_id', $seatRow->id)
                ->where('position', $nomor)
                ->first();

            if (!$seat) {
                $this->failed[] = "Baris Excel " . ($index + 2) . ": kursi nomor {$nomor} di baris {$baris} tidak ditemukan.";
                continue;
            }

            $existingGraduate = Graduate::where('seat_id', $seat->id)->first();
            if ($existingGraduate) {
                $this->failed[] = "Baris Excel " . ($index + 2) . ": kursi {$baris}{$nomor} sudah terisi.";
                continue;
            }

            Graduate::create([
                'graduation_session_id' => $this->session->id,
                'faculty_id' => $faculty->id,
                // 'jenjang' => $studyProgram->degree_level,
                'study_program_id' => $studyProgram->id,
                'nrp' => $nrp,
                'name' => $nama,
                'seat_id' => $seat->id,
            ]);

            $this->success++;
        }
    }
}
