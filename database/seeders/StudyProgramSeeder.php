<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudyProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudyProgramSeeder extends Seeder
{
    public function run(): void
    {
        // Kumpulan data Prodi dari semua Fakultas 
        $data = [
            // 1. FSAD (Fakultas Sains dan Analitika Data)
            ['faculty_id' => 1, 'name' => 'Fisika', 'degree_level' => 'S1'],
            ['faculty_id' => 1, 'name' => 'Fisika', 'degree_level' => 'S2'],
            ['faculty_id' => 1, 'name' => 'Ilmu Fisika', 'degree_level' => 'S3'],
            ['faculty_id' => 1, 'name' => 'Matematika', 'degree_level' => 'S1'],
            ['faculty_id' => 1, 'name' => 'Matematika', 'degree_level' => 'S2'],
            ['faculty_id' => 1, 'name' => 'Matematika', 'degree_level' => 'S3'],
            ['faculty_id' => 1, 'name' => 'Statistika', 'degree_level' => 'S1'],
            ['faculty_id' => 1, 'name' => 'Statistika', 'degree_level' => 'IUP'],
            ['faculty_id' => 1, 'name' => 'Sains Data', 'degree_level' => 'S1'],
            ['faculty_id' => 1, 'name' => 'Statistika', 'degree_level' => 'S2'],
            ['faculty_id' => 1, 'name' => 'Ilmu Statistik', 'degree_level' => 'S3'],
            ['faculty_id' => 1, 'name' => 'Kimia', 'degree_level' => 'S1'],
            ['faculty_id' => 1, 'name' => 'Sains Analitik dan Instrumentasi Kimia', 'degree_level' => 'S1'],
            ['faculty_id' => 1, 'name' => 'Kimia', 'degree_level' => 'S2'],
            ['faculty_id' => 1, 'name' => 'Kimia', 'degree_level' => 'S3'],
            ['faculty_id' => 1, 'name' => 'Biologi', 'degree_level' => 'S1'],
            ['faculty_id' => 1, 'name' => 'Bioteknologi', 'degree_level' => 'S1'],
            ['faculty_id' => 1, 'name' => 'Biologi', 'degree_level' => 'S2'],
            ['faculty_id' => 1, 'name' => 'Sains Aktuaria', 'degree_level' => 'S1'],
            ['faculty_id' => 1, 'name' => 'Sains Aktuaria', 'degree_level' => 'S2'],

            // 2. FTIRS (Fakultas Teknologi Industri dan Rekayasa Sistem)
            ['faculty_id' => 2, 'name' => 'Teknik Mesin', 'degree_level' => 'S1'],
            ['faculty_id' => 2, 'name' => 'Teknik Mesin', 'degree_level' => 'IUP'],
            ['faculty_id' => 2, 'name' => 'Rekayasa Keselamatan Proses', 'degree_level' => 'S1'],
            ['faculty_id' => 2, 'name' => 'Teknik Mesin', 'degree_level' => 'S2'],
            ['faculty_id' => 2, 'name' => 'Teknik Mesin', 'degree_level' => 'S3'],
            ['faculty_id' => 2, 'name' => 'Teknik Kimia', 'degree_level' => 'S1'],
            ['faculty_id' => 2, 'name' => 'Teknik Pangan', 'degree_level' => 'S1'],
            ['faculty_id' => 2, 'name' => 'Teknik Kimia', 'degree_level' => 'S2'],
            ['faculty_id' => 2, 'name' => 'Teknik Kimia', 'degree_level' => 'S3'],
            ['faculty_id' => 2, 'name' => 'Teknik Fisika', 'degree_level' => 'S1'],
            ['faculty_id' => 2, 'name' => 'Teknik Fisika', 'degree_level' => 'S2'],
            ['faculty_id' => 2, 'name' => 'Teknik Fisika', 'degree_level' => 'S3'],
            ['faculty_id' => 2, 'name' => 'Teknik Industri', 'degree_level' => 'S1'],
            ['faculty_id' => 2, 'name' => 'Teknik Industri', 'degree_level' => 'S2'],
            ['faculty_id' => 2, 'name' => 'Teknik Industri', 'degree_level' => 'S3'],
            ['faculty_id' => 2, 'name' => 'Teknik Material', 'degree_level' => 'S1'],
            ['faculty_id' => 2, 'name' => 'Teknik Material', 'degree_level' => 'IUP'],
            ['faculty_id' => 2, 'name' => 'Teknik Material', 'degree_level' => 'S2'],
            ['faculty_id' => 2, 'name' => 'Teknik Material', 'degree_level' => 'S3'],

            // 3. FTSPK (Fakultas Teknologi Sipil, Perencanaan, dan Kebumian)
            ['faculty_id' => 3, 'name' => 'Teknik Sipil', 'degree_level' => 'S1'],
            ['faculty_id' => 3, 'name' => 'Teknik Sipil', 'degree_level' => 'S2'],
            ['faculty_id' => 3, 'name' => 'Teknik Sipil', 'degree_level' => 'S3'],
            ['faculty_id' => 3, 'name' => 'Arsitektur', 'degree_level' => 'S1'],
            ['faculty_id' => 3, 'name' => 'Arsitektur', 'degree_level' => 'IUP'],
            ['faculty_id' => 3, 'name' => 'Arsitektur', 'degree_level' => 'S2'],
            ['faculty_id' => 3, 'name' => 'Arsitektur', 'degree_level' => 'S3'],
            ['faculty_id' => 3, 'name' => 'Arsitek', 'degree_level' => 'Profesi'],
            ['faculty_id' => 3, 'name' => 'Teknik Lingkungan', 'degree_level' => 'S1'],
            ['faculty_id' => 3, 'name' => 'Teknik Lingkungan', 'degree_level' => 'IUP'],
            ['faculty_id' => 3, 'name' => 'Teknik Lingkungan', 'degree_level' => 'S2'],
            ['faculty_id' => 3, 'name' => 'Teknik Lingkungan', 'degree_level' => 'S3'],
            ['faculty_id' => 3, 'name' => 'Mandiri', 'degree_level' => 'Profesi'],
            ['faculty_id' => 3, 'name' => 'Teknik Geomatika', 'degree_level' => 'S1'],
            ['faculty_id' => 3, 'name' => 'Teknik Geomatika', 'degree_level' => 'IUP'],
            ['faculty_id' => 3, 'name' => 'Teknik Geomatika', 'degree_level' => 'S2'],
            ['faculty_id' => 3, 'name' => 'Teknik Geomatika', 'degree_level' => 'S3'],
            ['faculty_id' => 3, 'name' => 'Perencanaan Wilayah dan Kota', 'degree_level' => 'S1'],
            ['faculty_id' => 3, 'name' => 'Perencanaan Wilayah dan Kota', 'degree_level' => 'S2'],
            ['faculty_id' => 3, 'name' => 'Teknik Geofisika', 'degree_level' => 'S1'],
            ['faculty_id' => 3, 'name' => 'Teknik Geofisika', 'degree_level' => 'IUP'],
            ['faculty_id' => 3, 'name' => 'Teknik Geofisika', 'degree_level' => 'S2'],
            ['faculty_id' => 3, 'name' => 'Teknik Pertambangan', 'degree_level' => 'S1'],

            // 4. FTK (Fakultas Teknologi Kelautan)
            ['faculty_id' => 4, 'name' => 'Teknik Perkapalan', 'degree_level' => 'S1'],
            ['faculty_id' => 4, 'name' => 'Teknik Perkapalan', 'degree_level' => 'S1'],
            ['faculty_id' => 4, 'name' => 'Teknik Perkapalan', 'degree_level' => 'S2'],
            ['faculty_id' => 4, 'name' => 'Teknik Perkapalan', 'degree_level' => 'S3'],
            ['faculty_id' => 4, 'name' => 'Teknik Sistem Perkapalan', 'degree_level' => 'S1'],
            ['faculty_id' => 4, 'name' => 'Teknik Sistem Perkapalan', 'degree_level' => 'Double Degree'],
            ['faculty_id' => 4, 'name' => 'Teknik Sistem Perkapalan', 'degree_level' => 'S2'],
            ['faculty_id' => 4, 'name' => 'Teknik Sistem Perkapalan', 'degree_level' => 'Double Degree'],
            ['faculty_id' => 4, 'name' => 'Teknik Sistem Perkapalan', 'degree_level' => 'S3'],
            ['faculty_id' => 4, 'name' => 'Teknik Kelautan', 'degree_level' => 'S1'],
            ['faculty_id' => 4, 'name' => 'Teknik Kelautan', 'degree_level' => 'S2'],
            ['faculty_id' => 4, 'name' => 'Teknik Kelautan', 'degree_level' => 'S3'],
            ['faculty_id' => 4, 'name' => 'Teknik Lepas Pantai', 'degree_level' => 'S1'],
            ['faculty_id' => 4, 'name' => 'Teknik Transportasi Laut', 'degree_level' => 'S1'],
            ['faculty_id' => 4, 'name' => 'Teknik Transportasi Laut', 'degree_level' => 'S2'],
            ['faculty_id' => 4, 'name' => 'Teknik Transportasi Laut', 'degree_level' => 'S2'],

            // 5. FTEIC (Fakultas Teknologi Elektro dan Informatika Cerdas)
            ['faculty_id' => 5, 'name' => 'Teknik Elektro', 'degree_level' => 'S1'],
            ['faculty_id' => 5, 'name' => 'Teknik Elektro', 'degree_level' => 'IUP'],
            ['faculty_id' => 5, 'name' => 'Teknik Elektro', 'degree_level' => 'S2'],
            ['faculty_id' => 5, 'name' => 'Teknik Elektro', 'degree_level' => 'S3'],
            ['faculty_id' => 5, 'name' => 'Teknik Informatika', 'degree_level' => 'S1'],
            ['faculty_id' => 5, 'name' => 'Teknik Informatika', 'degree_level' => 'IUP'],
            ['faculty_id' => 5, 'name' => 'Rekayasa Perangkat Lunak', 'degree_level' => 'S1'],
            ['faculty_id' => 5, 'name' => 'Rekayasa Kecerdasan Artifisial', 'degree_level' => 'S1'],
            ['faculty_id' => 5, 'name' => 'Teknik Informatika', 'degree_level' => 'S2'],
            ['faculty_id' => 5, 'name' => 'Ilmu Komputer', 'degree_level' => 'S3'],
            ['faculty_id' => 5, 'name' => 'Sistem Informasi', 'degree_level' => 'S1'],
            ['faculty_id' => 5, 'name' => 'Sistem Informasi', 'degree_level' => 'IUP'],
            ['faculty_id' => 5, 'name' => 'Sistem Informasi', 'degree_level' => 'S2'],
            ['faculty_id' => 5, 'name' => 'Sistem Informasi', 'degree_level' => 'S3'],
            ['faculty_id' => 5, 'name' => 'Inovasi Digital', 'degree_level' => 'S1 ID'],
            ['faculty_id' => 5, 'name' => 'Teknik Komputer', 'degree_level' => 'S1'],
            ['faculty_id' => 5, 'name' => 'Teknik Biomedik', 'degree_level' => 'S1'],
            ['faculty_id' => 5, 'name' => 'Teknologi Informasi', 'degree_level' => 'S1'],
            ['faculty_id' => 5, 'name' => 'Teknik Telekomunikasi', 'degree_level' => 'S1'],

            // 6. FDKBD (Fakultas Desain Kreatif dan Bisnis Digital)
            ['faculty_id' => 6, 'name' => 'Desain Produk', 'degree_level' => 'S1'],
            ['faculty_id' => 6, 'name' => 'Desain Interior', 'degree_level' => 'S1'],
            ['faculty_id' => 6, 'name' => 'Desain Interior', 'degree_level' => 'S2'],
            ['faculty_id' => 6, 'name' => 'Desain Komunikasi Visual', 'degree_level' => 'S1'],
            ['faculty_id' => 6, 'name' => 'Manajemen Bisnis', 'degree_level' => 'S1'],
            ['faculty_id' => 6, 'name' => 'Manajemen Bisnis', 'degree_level' => 'IUP'],
            ['faculty_id' => 6, 'name' => 'Bisnis Digital', 'degree_level' => 'S1'],
            ['faculty_id' => 6, 'name' => 'Mobilitas Internasional', 'degree_level' => 'Non-Degree'],
            ['faculty_id' => 6, 'name' => 'Ilmu Manajemen', 'degree_level' => 'S2'],
            ['faculty_id' => 6, 'name' => 'Studi Pembangunan', 'degree_level' => 'S1'],
            ['faculty_id' => 6, 'name' => 'Sains Komunikasi', 'degree_level' => 'S1'],

            // 7. FV (Fakultas Vokasi)
            ['faculty_id' => 7, 'name' => 'Teknik Sipil', 'degree_level' => 'D4'],
            ['faculty_id' => 7, 'name' => 'Teknologi Rekayasa Konstruksi Bangunan Air', 'degree_level' => 'D4'],
            ['faculty_id' => 7, 'name' => 'Rekayasa Perawatan dan Restorasi Bangunan Sipil', 'degree_level' => 'S2 Terapan'],
            ['faculty_id' => 7, 'name' => 'Teknologi Rekayasa Manufaktur', 'degree_level' => 'D4'],
            ['faculty_id' => 7, 'name' => 'Teknologi Rekayasa Konversi Energi', 'degree_level' => 'D4'],
            ['faculty_id' => 7, 'name' => 'Teknologi Rekayasa Otomasi', 'degree_level' => 'D4'],
            ['faculty_id' => 7, 'name' => 'Teknologi Rekayasa Kimia Industri', 'degree_level' => 'D4'],
            ['faculty_id' => 7, 'name' => 'Rekayasa Teknologi Instrumentasi', 'degree_level' => 'D4'],
            ['faculty_id' => 7, 'name' => 'Statistika Bisnis', 'degree_level' => 'D4'],
            ['faculty_id' => 7, 'name' => 'Analitika Logistik', 'degree_level' => 'D4'],

            // 8. FKK (Fakultas Kedokteran dan Kesehatan)
            ['faculty_id' => 8, 'name' => 'Teknologi Kedokteran', 'degree_level' => 'S1'],
            ['faculty_id' => 8, 'name' => 'Kedokteran', 'degree_level' => 'S1'],
            ['faculty_id' => 8, 'name' => 'Dokter', 'degree_level' => 'Profesi'],

            // 9. SIMT (Sekolah Interdisiplin Manajemen dan Teknologi)
            ['faculty_id' => 9, 'name' => 'Manajemen Teknologi', 'degree_level' => 'S2'],
            ['faculty_id' => 9, 'name' => 'Manajemen Teknologi', 'degree_level' => 'S3'],
            ['faculty_id' => 9, 'name' => 'Inovasi Sistem dan Teknologi', 'degree_level' => 'S2'],
            ['faculty_id' => 9, 'name' => 'Insinyur', 'degree_level' => 'Profesi'],
        ];

        StudyProgram::insert($data);
    }
}