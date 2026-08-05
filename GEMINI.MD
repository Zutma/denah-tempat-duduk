# Product Requirement Document (PRD)
## Aplikasi Pengelolaan & Denah Tempat Duduk Mahasiswa (Web App)

### 1. Overview & Objective
Aplikasi ini adalah Web App berbasis **Laravel (PHP)** dan **MySQL** yang bertujuan untuk memudahkan dosen/admin dalam mengelola alokasi tempat duduk mahasiswa (misalnya untuk ujian atau perkuliahan) secara otomatis melalui fitur **Import File Excel**.

Aplikasi akan membaca daftar mahasiswa dari Excel, memetakan posisi duduk berdasarkan tata letak ruangan (baris x kolom), dan menyajikannya dalam bentuk denah visual interaktif yang dapat dicetak atau diekspor kembali.

---

### 2. User Roles & Authentication
1. **Admin / Dosen / Panitia:**
   * Memiliki akses penuh (Login required).
   * Mengelola data mahasiswa, ruangan, import Excel, dan melakukan plotting tempat duduk.
2. **Mahasiswa (Public Access / Non-Login):**
   * Hanya akses halaman pencarian di bagian depan.
   * Menginput NIM untuk melihat posisi duduk dan nomor ruangan secara cepat.

---

### 3. Core Features & Functional Requirements

#### A. Module 1: Authentication & Dashboard
* System login sederhana untuk Admin/Dosen.
* Dashboard menampilkan ringkasan: jumlah ruangan, total mahasiswa terdaftar, dan sesi tempat duduk yang aktif.

#### B. Module 2: Import & Data Management (CRUD)
* **Import Excel (.xlsx):**
  * Upload file Excel berisi kolom: `NIM`, `Nama`, `Kelas/Jurusan`.
  * **Validasi Input:** Sistem harus mendeteksi dan menolak data jika ada NIM ganda atau kolom wajib yang kosong.
* **CRUD Mahasiswa:** Menampilkan data ter-import dalam bentuk tabel dengan fitur **Pagination** (10-20 data per halaman) dan pencarian instan.
* **CRUD Ruangan:**
  * Input nama ruangan (contoh: `Ruang A-101`).
  * Konfigurasi dimensi ruangan: `Jumlah Baris (R)` x `Jumlah Kolom (C)`.

#### C. Module 3: Seat Plotting Engine (Algoritma Penataan Duduk)
Sistem dapat memetakan mahasiswa dari daftar ke dalam matriks ruangan dengan opsi:
1. **Sequential Plotting:** Pengisian berurutan dari pojok kiri depan ke belakang berdasarkan NIM/Nama.
2. **Random/Acak Plotting:** Pengisian acak untuk kebutuhan ujian.
3. **Cross-Class/Jurusan Plotting (Opsional/Advanced):** Memastikan mahasiswa dari kelas yang sama tidak duduk berdampingan.

#### D. Module 4: Visual Seat Map (UI Denah Interaktif)
* Menampilkan denah kelas dalam bentuk **Grid Matriks** ($R \times C$).
* Elemen visual: Area Meja Dosen / Papan Tulis di posisi depan.
* **Status Kursi (Color Coded):**
  * *Hijau:* Kursi terisi (Menampilkan Nama & NIM Mahasiswa).
  * *Abu-abu:* Kursi kosong.
  * *Merah:* Kursi rusak/tidak bisa dipakai.
* **Manual Adjustment:** Fitur *Swap/Drag-and-Drop* untuk memindahkan posisi duduk 2 mahasiswa jika ada kondisi khusus.

#### E. Module 5: Export & Search
* **Export PDF:** Cetak denah tempat duduk siap pakai untuk ditempel di pintu ruangan.
* **Export Excel:** Mengunduh kembali data mahasiswa beserta lokasi baris & kolom duduknya.
* **Public Search:** Halaman pencarian cepat berdasarkan NIM untuk mahasiswa.

---

### 4. Technical Architecture & Tech Stack
* **Backend Framework:** Laravel (PHP 11+)
* **Database:** MySQL / MariaDB
* **Excel Library:** `maatwebsite/excel` (Laravel-Excel)
* **Frontend Template:** Blade Engine + Tailwind CSS
* **JavaScript Library:** Alpine.js / Native JS (untuk interaksi grid & swap)
* **PDF Engine:** `barryvdh/laravel-dompdf`

---

### 5. Database Schema (Draft Entity Model)

1. **`users`**
   * `id`, `name`, `email`, `password`, `created_at`
2. **`mahasiswa`**
   * `id`, `nim` (unique), `nama`, `kelas`, `created_at`
3. **`ruangan`**
   * `id`, `nama_ruangan`, `jumlah_baris`, `jumlah_kolom`, `kapasitas_total`
4. **`denah_detail`**
   * `id`, `ruangan_id`, `mahasiswa_id`, `baris_ke`, `kolom_ke`, `status_kursi`

---

### 6. Development Phasing (Vertical Slice Implementation)

* **Phase 1 (Foundation & Auth):** Setup Laravel + Breeze Auth + Migration Database dasar.
* **Phase 2 (CRUD & Excel Import):** Setup `Laravel-Excel`, buat form upload file, dan tabel data mahasiswa dengan Pagination.
* **Phase 3 (Room & Basic Grid UI):** Buat manajemen ruangan dan komponen grid HTML/Tailwind untuk denah.
* **Phase 4 (Plotting Engine):** Buat logika pemetaan otomatis dari data mahasiswa ke grid ruangan.
* **Phase 5 (Refinement & Export):** Tambahkan fitur swap manual, cetak PDF, dan halaman pencarian NIM.