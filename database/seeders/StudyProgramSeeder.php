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
            ['faculty_id' => 1, 'name' => 'Sarjana Fisika', 'degree_level' => 'S1'],
            ['faculty_id' => 1, 'name' => 'Magister Fisika', 'degree_level' => 'S2'],
            ['faculty_id' => 1, 'name' => 'Doktor Ilmu Fisika', 'degree_level' => 'S3'],
            ['faculty_id' => 1, 'name' => 'Sarjana Matematika', 'degree_level' => 'S1'],
            ['faculty_id' => 1, 'name' => 'Magister Matematika', 'degree_level' => 'S2'],
            ['faculty_id' => 1, 'name' => 'Doktor Matematika', 'degree_level' => 'S3'],
            ['faculty_id' => 1, 'name' => 'Sarjana Statistika', 'degree_level' => 'S1'],
            ['faculty_id' => 1, 'name' => 'Sarjana Statistika', 'degree_level' => 'IUP'],
            ['faculty_id' => 1, 'name' => 'Sarjana Sains Data', 'degree_level' => 'S1'],
            ['faculty_id' => 1, 'name' => 'Magister Statistika', 'degree_level' => 'S2'],
            ['faculty_id' => 1, 'name' => 'Doktor Ilmu Statistik', 'degree_level' => 'S3'],
            ['faculty_id' => 1, 'name' => 'Sarjana Kimia', 'degree_level' => 'S1'],
            ['faculty_id' => 1, 'name' => 'Sarjana Sains Analitik dan Instrumentasi Kimia', 'degree_level' => 'S1'],
            ['faculty_id' => 1, 'name' => 'Magister Kimia', 'degree_level' => 'S2'],
            ['faculty_id' => 1, 'name' => 'Doktor Kimia', 'degree_level' => 'S3'],
            ['faculty_id' => 1, 'name' => 'Sarjana Biologi', 'degree_level' => 'S1'],
            ['faculty_id' => 1, 'name' => 'Sarjana Bioteknologi', 'degree_level' => 'S1'],
            ['faculty_id' => 1, 'name' => 'Magister Biologi', 'degree_level' => 'S2'],
            ['faculty_id' => 1, 'name' => 'Sarjana Sains Aktuaria', 'degree_level' => 'S1'],
            ['faculty_id' => 1, 'name' => 'Magister Sains Aktuaria', 'degree_level' => 'S2'],

            // 2. FTIRS (Fakultas Teknologi Industri dan Rekayasa Sistem)
            ['faculty_id' => 2, 'name' => 'Sarjana Teknik Mesin', 'degree_level' => 'S1'],
            ['faculty_id' => 2, 'name' => 'Sarjana Teknik Mesin', 'degree_level' => 'IUP'],
            ['faculty_id' => 2, 'name' => 'Sarjana Rekayasa Keselamatan Proses', 'degree_level' => 'S1'],
            ['faculty_id' => 2, 'name' => 'Magister Teknik Mesin', 'degree_level' => 'S2'],
            ['faculty_id' => 2, 'name' => 'Doktor Teknik Mesin', 'degree_level' => 'S3'],
            ['faculty_id' => 2, 'name' => 'Sarjana Teknik Kimia', 'degree_level' => 'S1'],
            ['faculty_id' => 2, 'name' => 'Sarjana Teknik Pangan', 'degree_level' => 'S1'],
            ['faculty_id' => 2, 'name' => 'Magister Teknik Kimia', 'degree_level' => 'S2'],
            ['faculty_id' => 2, 'name' => 'Doktor Teknik Kimia', 'degree_level' => 'S3'],
            ['faculty_id' => 2, 'name' => 'Sarjana Teknik Fisika', 'degree_level' => 'S1'],
            ['faculty_id' => 2, 'name' => 'Magister Teknik Fisika', 'degree_level' => 'S2'],
            ['faculty_id' => 2, 'name' => 'Doktor Teknik Fisika', 'degree_level' => 'S3'],
            ['faculty_id' => 2, 'name' => 'Sarjana Teknik Industri', 'degree_level' => 'S1'],
            ['faculty_id' => 2, 'name' => 'Magister Teknik Industri', 'degree_level' => 'S2'],
            ['faculty_id' => 2, 'name' => 'Doktor Teknik Industri', 'degree_level' => 'S3'],
            ['faculty_id' => 2, 'name' => 'Sarjana Teknik Material', 'degree_level' => 'S1'],
            ['faculty_id' => 2, 'name' => 'Sarjana Teknik Material', 'degree_level' => 'IUP'],
            ['faculty_id' => 2, 'name' => 'Magister Teknik Material', 'degree_level' => 'S2'],
            ['faculty_id' => 2, 'name' => 'Doktor Teknik Material', 'degree_level' => 'S3'],

            // 3. FTSPK (Fakultas Teknologi Sipil, Perencanaan, dan Kebumian)
            ['faculty_id' => 3, 'name' => 'Sarjana Teknik Sipil', 'degree_level' => 'S1'],
            ['faculty_id' => 3, 'name' => 'Magister Teknik Sipil', 'degree_level' => 'S2'],
            ['faculty_id' => 3, 'name' => 'Doktor Teknik Sipil', 'degree_level' => 'S3'],
            ['faculty_id' => 3, 'name' => 'Sarjana Arsitektur', 'degree_level' => 'S1'],
            ['faculty_id' => 3, 'name' => 'Sarjana Arsitektur', 'degree_level' => 'IUP'],
            ['faculty_id' => 3, 'name' => 'Magister Arsitektur', 'degree_level' => 'S2'],
            ['faculty_id' => 3, 'name' => 'Doktor Arsitektur', 'degree_level' => 'S3'],
            ['faculty_id' => 3, 'name' => 'Pendidikan Profesi Arsitek', 'degree_level' => 'Profesi'],
            ['faculty_id' => 3, 'name' => 'Sarjana Teknik Lingkungan', 'degree_level' => 'S1'],
            ['faculty_id' => 3, 'name' => 'Sarjana Teknik Lingkungan', 'degree_level' => 'IUP'],
            ['faculty_id' => 3, 'name' => 'Magister Teknik Lingkungan', 'degree_level' => 'S2'],
            ['faculty_id' => 3, 'name' => 'Doktor Teknik Lingkungan', 'degree_level' => 'S3'],
            ['faculty_id' => 3, 'name' => 'Pendidikan Profesi Mandiri', 'degree_level' => 'Profesi'],
            ['faculty_id' => 3, 'name' => 'Sarjana Teknik Geomatika', 'degree_level' => 'S1'],
            ['faculty_id' => 3, 'name' => 'Sarjana Teknik Geomatika', 'degree_level' => 'IUP'],
            ['faculty_id' => 3, 'name' => 'Magister Teknik Geomatika', 'degree_level' => 'S2'],
            ['faculty_id' => 3, 'name' => 'Doktor Teknik Geomatika', 'degree_level' => 'S3'],
            ['faculty_id' => 3, 'name' => 'Sarjana Perencanaan Wilayah dan Kota', 'degree_level' => 'S1'],
            ['faculty_id' => 3, 'name' => 'Magister Perencanaan Wilayah dan Kota', 'degree_level' => 'S2'],
            ['faculty_id' => 3, 'name' => 'Sarjana Teknik Geofisika', 'degree_level' => 'S1'],
            ['faculty_id' => 3, 'name' => 'Sarjana Teknik Geofisika', 'degree_level' => 'IUP'],
            ['faculty_id' => 3, 'name' => 'Magister Teknik Geofisika', 'degree_level' => 'S2'],
            ['faculty_id' => 3, 'name' => 'Sarjana Teknik Pertambangan', 'degree_level' => 'S1'],

            // 4. FTK (Fakultas Teknologi Kelautan)
            ['faculty_id' => 4, 'name' => 'Sarjana Teknik Perkapalan', 'degree_level' => 'S1'],
            ['faculty_id' => 4, 'name' => 'Sarjana Teknik Perkapalan Join Degree', 'degree_level' => 'S1'],
            ['faculty_id' => 4, 'name' => 'Magister Teknik Perkapalan', 'degree_level' => 'S2'],
            ['faculty_id' => 4, 'name' => 'Doktor Teknik Perkapalan', 'degree_level' => 'S3'],
            ['faculty_id' => 4, 'name' => 'Sarjana Teknik Sistem Perkapalan', 'degree_level' => 'S1'],
            ['faculty_id' => 4, 'name' => 'Sarjana Teknik Sistem Perkapalan', 'degree_level' => 'Double Degree'],
            ['faculty_id' => 4, 'name' => 'Magister Teknik Sistem Perkapalan', 'degree_level' => 'S2'],
            ['faculty_id' => 4, 'name' => 'Magister Teknik Sistem Perkapalan', 'degree_level' => 'Double Degree'],
            ['faculty_id' => 4, 'name' => 'Doktor Teknik Sistem Perkapalan', 'degree_level' => 'S3'],
            ['faculty_id' => 4, 'name' => 'Sarjana Teknik Kelautan', 'degree_level' => 'S1'],
            ['faculty_id' => 4, 'name' => 'Magister Teknik Kelautan', 'degree_level' => 'S2'],
            ['faculty_id' => 4, 'name' => 'Doktoral Teknik Kelautan', 'degree_level' => 'S3'],
            ['faculty_id' => 4, 'name' => 'Sarjana Teknik Lepas Pantai', 'degree_level' => 'S1'],
            ['faculty_id' => 4, 'name' => 'Sarjana Teknik Transportasi Laut', 'degree_level' => 'S1'],
            ['faculty_id' => 4, 'name' => 'Magister Teknik Transportasi Laut', 'degree_level' => 'S2'],
            ['faculty_id' => 4, 'name' => 'Magister Double Degree Teknik Transportasi Laut', 'degree_level' => 'S2'],

            // 5. FTEIC (Fakultas Teknologi Elektro dan Informatika Cerdas)
            ['faculty_id' => 5, 'name' => 'Sarjana Teknik Elektro', 'degree_level' => 'S1'],
            ['faculty_id' => 5, 'name' => 'Sarjana Teknik Elektro', 'degree_level' => 'IUP'],
            ['faculty_id' => 5, 'name' => 'Magister Teknik Elektro', 'degree_level' => 'S2'],
            ['faculty_id' => 5, 'name' => 'Doktoral Teknik Elektro', 'degree_level' => 'S3'],
            ['faculty_id' => 5, 'name' => 'Sarjana Teknik Informatika', 'degree_level' => 'S1'],
            ['faculty_id' => 5, 'name' => 'Sarjana Teknik Informatika', 'degree_level' => 'IUP'],
            ['faculty_id' => 5, 'name' => 'Sarjana Rekayasa Perangkat Lunak', 'degree_level' => 'S1'],
            ['faculty_id' => 5, 'name' => 'Sarjana Rekayasa Kecerdasan Artifisial', 'degree_level' => 'S1'],
            ['faculty_id' => 5, 'name' => 'Magister Teknik Informatika', 'degree_level' => 'S2'],
            ['faculty_id' => 5, 'name' => 'Doktoral Ilmu Komputer', 'degree_level' => 'S3'],
            ['faculty_id' => 5, 'name' => 'Sarjana Sistem Informasi', 'degree_level' => 'S1'],
            ['faculty_id' => 5, 'name' => 'Sarjana Sistem Informasi', 'degree_level' => 'IUP'],
            ['faculty_id' => 5, 'name' => 'Magister Sistem Informasi', 'degree_level' => 'S2'],
            ['faculty_id' => 5, 'name' => 'Doktor Sistem Informasi', 'degree_level' => 'S3'],
            ['faculty_id' => 5, 'name' => 'Sarjana Inovasi Digital', 'degree_level' => 'S1 ID'],
            ['faculty_id' => 5, 'name' => 'Sarjana Teknik Komputer', 'degree_level' => 'S1'],
            ['faculty_id' => 5, 'name' => 'Sarjana Teknik Biomedik', 'degree_level' => 'S1'],
            ['faculty_id' => 5, 'name' => 'Sarjana Teknologi Informasi', 'degree_level' => 'S1'],
            ['faculty_id' => 5, 'name' => 'Sarjana Teknik Telekomunikasi', 'degree_level' => 'S1'],

            // 6. FDKBD (Fakultas Desain Kreatif dan Bisnis Digital)
            ['faculty_id' => 6, 'name' => 'Sarjana Desain Produk', 'degree_level' => 'S1'],
            ['faculty_id' => 6, 'name' => 'Sarjana Desain Interior', 'degree_level' => 'S1'],
            ['faculty_id' => 6, 'name' => 'Magister Desain Interior', 'degree_level' => 'S2'],
            ['faculty_id' => 6, 'name' => 'Sarjana Desain Komunikasi Visual', 'degree_level' => 'S1'],
            ['faculty_id' => 6, 'name' => 'Sarjana Manajemen Bisnis', 'degree_level' => 'S1'],
            ['faculty_id' => 6, 'name' => 'Sarjana Manajemen Bisnis', 'degree_level' => 'IUP'],
            ['faculty_id' => 6, 'name' => 'Sarjana Bisnis Digital', 'degree_level' => 'S1'],
            ['faculty_id' => 6, 'name' => 'Program Mobilitas Internasional', 'degree_level' => 'Non-Degree'],
            ['faculty_id' => 6, 'name' => 'Magister Ilmu Manajemen', 'degree_level' => 'S2'],
            ['faculty_id' => 6, 'name' => 'Sarjana Studi Pembangunan', 'degree_level' => 'S1'],
            ['faculty_id' => 6, 'name' => 'Sarjana Sains Komunikasi', 'degree_level' => 'S1'],

            // 7. FV (Fakultas Vokasi)
            ['faculty_id' => 7, 'name' => 'Sarjana Terapan Teknik Sipil', 'degree_level' => 'D4'],
            ['faculty_id' => 7, 'name' => 'Sarjana Terapan Teknologi Rekayasa Konstruksi Bangunan Air', 'degree_level' => 'D4'],
            ['faculty_id' => 7, 'name' => 'Magister Terapan Rekayasa Perawatan dan Restorasi Bangunan Sipil', 'degree_level' => 'S2 Terapan'],
            ['faculty_id' => 7, 'name' => 'Sarjana Terapan Teknologi Rekayasa Manufaktur', 'degree_level' => 'D4'],
            ['faculty_id' => 7, 'name' => 'Sarjana Terapan Teknologi Rekayasa Konversi Energi', 'degree_level' => 'D4'],
            ['faculty_id' => 7, 'name' => 'Sarjana Terapan Teknologi Rekayasa Otomasi', 'degree_level' => 'D4'],
            ['faculty_id' => 7, 'name' => 'Sarjana Terapan Teknik Teknologi Rekayasa Kimia Industri', 'degree_level' => 'D4'],
            ['faculty_id' => 7, 'name' => 'Sarjana Terapan Rekayasa Teknologi Instrumentasi', 'degree_level' => 'D4'],
            ['faculty_id' => 7, 'name' => 'Sarjana Terapan Statistika Bisnis', 'degree_level' => 'D4'],
            ['faculty_id' => 7, 'name' => 'Sarjana Terapan Analitika Logistik Terapan', 'degree_level' => 'D4'],

            // 8. FKK (Fakultas Kedokteran dan Kesehatan)
            ['faculty_id' => 8, 'name' => 'Sarjana Teknologi Kedokteran', 'degree_level' => 'S1'],
            ['faculty_id' => 8, 'name' => 'Sarjana Kedokteran', 'degree_level' => 'S1'],
            ['faculty_id' => 8, 'name' => 'Pendidikan Profesi Dokter', 'degree_level' => 'Profesi'],

            // 9. SIMT (Sekolah Interdisiplin Manajemen dan Teknologi)
            ['faculty_id' => 9, 'name' => 'Magister Manajemen Teknologi', 'degree_level' => 'S2'],
            ['faculty_id' => 9, 'name' => 'Doktor Manajemen Teknologi', 'degree_level' => 'S3'],
            ['faculty_id' => 9, 'name' => 'Magister Inovasi Sistem dan Teknologi', 'degree_level' => 'S2'],
            ['faculty_id' => 9, 'name' => 'Profesi Insinyur', 'degree_level' => 'Profesi'],
        ];

        StudyProgram::insert($data);
    }
}
