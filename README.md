# CAIKUE (Catatan Industri dan Kuesioner Ekonomi Digital)

Aplikasi berbasis web untuk manajemen sistem kuesioner dan formulir industri digital secara umum. Dibangun menggunakan framework **Laravel 10**, **Tailwind CSS**, dan **Alpine.js**, aplikasi ini memungkinkan pembuatan kuesioner, pengelolaan jawaban pengguna, serta ekspor laporan jawaban kuesioner.

## 🚀 Fitur Utama

- **Manajemen Pengguna & Peran (Role):** Pengelolaan data pengguna (admin, user), role, dan daftar pegawai/tim.
- **Manajemen Kuesioner & Formulir:** Pembuatan kuesioner secara dinamis yang dapat disesuaikan parameter opsi pertanyaannya.
- **Pengisian Kuesioner (Jawaban):** Pengguna dengan autentikasi dapat mengisi kuesioner atau formulir dengan beragam tipe pertanyaan.
- **Ekspor Laporan:**
  - Ekspor rekap jawaban kuesioner ke format **Excel** menggunakan fitur spreadsheet.
  - Ekspor form/jawaban ke dokumen **PDF**.
- **Profil Pengguna:** Manajemen data profil diri dan pengaturan kata sandi akun pengguna.

## 🛠️ Teknologi (Tech Stack)

Aplikasi ini dikembangkan di atas ekosistem modern TALL-like Stack (Tailwind, Alpine, Laravel):
- **Backend:** Laravel Framework v10, PHP (`^8.1`), MySQL Database
- **Frontend:** Tailwind CSS, Alpine.js, dikonfigurasi melalui Vite Build Tool
- **Package Penting:**
  - `barryvdh/laravel-dompdf` untuk pembuatan file ekspor PDF.
  - `maatwebsite/excel` untuk rekapitulasi pelaporan data format Excel.
  - `akaunting/laravel-money` untuk format kebutuhan data mata uang.

## 📋 Prasyarat Sistem

Sebelum menginstal dan menjalankan aplikasi ini secara lokal (*local development*), pastikan environment kerja Anda telah memenuhi:
- **PHP** >= 8.1
- **Composer** (untuk dependensi PHP)
- **Node.js** & **NPM** (untuk styling Vite)
- **MySQL** atau MariaDB Server

## ⚙️ Panduan Instalasi dan Menjalankan Proyek

Ikuti panduan di bawah ini untuk memulai mengembangkan aplikasi di komputer Anda:

1. **Clone repositori** aplikasi atau ekstrak source-code ke dalam virtual web-server lingkungan lokal.

2. **Masuk ke folder direktori aplikasi aplikasi:**
   ```bash
   cd nama-folder-skrip
   ```

3. **Install *dependencies* PHP / Laravel:**
   ```bash
   composer install
   ```

4. **Install *dependencies* Node.js untuk Frontend Asset:**
   ```bash
   npm install
   ```

5. **Pengaturan Environment Variabel:**
   Konfigurasikan credential environment yang digunakan dengan melakukan copy file `.env.example`.
   ```bash
   cp .env.example .env
   ```
   Buka konfigurasi file `.env` yang baru dibuat di teks editor lalu sesuaikan kredensial databasenya:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database_anda
   DB_USERNAME=root
   DB_PASSWORD=password_database_anda
   ```

6. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

7. **Migrasi dan Seeder Database:**
   Proses pembuatan tabel-tabel ke database dan pengisian base data awal.
   ```bash
   php artisan migrate --seed
   ```

8. **Menjalankan Aplikasi (Local Server):**
   Anda dianjurkan menjalankan kompilasi Vite dan *local server* Laravel secara bersamaan di terminal terpisah.
   
   *Terminal 1 (Vite Server - Hot Module Replacement untuk styling Frontend):*
   ```bash
   npm run dev
   ```

   *Terminal 2 (Laravel Artisan Server - Backend Processing):*
   ```bash
   php artisan serve
   ```

9. Aplikasi web sekarang siap diakses pada browser di [http://localhost:8000](http://localhost:8000).

## 📂 Gambaran Struktur Kode Khusus

Struktur dari proyek ini memperluas file dasar Laravel. Fitur-fitur utamanya terletak pada:
- `app/Models/` : Terdiri dari model Eloquent untuk transaksi form (misalnya: `User`, `Kuesioner`, `Form`, `AnswerDetail`, `Pegawai`, dll).
- `app/Http/Controllers/` : Logic backend untuk menata dan merender data form (seperti `FormController`, `KuesionerController`, `ManageUserController`, dan `JawabanController`).
- `routes/web.php` : Definisi *routing* lalu lintas halaman menggunakan proteksi authentication.
- `resources/views/` : Kumpulan *template engine* berbasis Blade yang telah di-inject dengan sintaks *alpine* dan *tailwind-class*. 

---
*Catatan: Dokumen file lama mengenai BAST, manual instalasi milestone, atau dokumentasi alih-hak yang mungkin terdapat pada versi repo lama tidak lagi berada di dalam file basis root dan dokumentasi instalasi.*
