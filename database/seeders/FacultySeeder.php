<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faculty::create([
            'code' => 'FSAD',
            'name' => 'Fakultas Sains dan Analitika Data',
            'color' => '#0F8140',
        ]);

        Faculty::create([
            'code' => 'FTIRS',
            'name' => 'Fakultas Teknologi Industri dan Rekayasa Sistem',
            'color' => '#B31E23',
        ]);

        Faculty::create([
            'code' => 'FTSPK',
            'name' => 'Fakultas Teknologi Sipil, Perencanaan, dan Kebumian',
            'color' => '#231F20',
        ]);

        Faculty::create([
            'code' => 'FTK',
            'name' => 'Fakultas Teknologi Kelautan',
            'color' => '#26AEE4',
        ]);

        Faculty::create([
            'code' => 'FTEIC',
            'name' => 'Fakultas Teknologi Elektro dan Informatika Cerdas',
            'color' => '#FFD700',
        ]);

        Faculty::create([
            'code' => 'FDKBD',
            'name' => 'Fakultas Desain Kreatif dan Bisnis Digital',
            'color' => '#4B0082',
        ]);

        Faculty::create([
            'code' => 'FV',
            'name' => 'Fakultas Vokasi',
            'color' => '#F47D52',
        ]);

        Faculty::create([
            'code' => 'FKK',
            'name' => 'Fakultas Kedokteran dan Kesehatan',
            'color' => '#12b0a2',
        ]);

        Faculty::create([
            'code' => 'SIMT',
            'name' => 'Sekolah Interdisiplin Manajemen dan Teknologi',
            'color' => '#192841',
        ]);

    }
}
