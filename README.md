# CAIKUE (Catatan Industri dan Kuesioner Ekonomi Digital)

Aplikasi **Identifikasi dan Pemetaan** ekonomi digital yang dioptimalkan untuk performa tinggi dan kemudahan distribusi. **CAIKUE** dirancang untuk memudahkan pengumpulan data lapangan secara publik guna memitigasi *undercoverage* dalam Sensus Ekonomi 2026 melalui integrasi WhatsApp dan sistem formulir dinamis yang responsif.

## 🚀 Fitur Unggulan

- **Identifikasi & Pemetaan:** Dirancang khusus untuk menjaring pelaku usaha digital yang belum terdata secara komprehensif.
- **UX Mobile-First:** Kuesioner menggunakan sistem *Radio/Checkbox Cards* yang ramah jempol dan responsif di berbagai perangkat.
- **Psychological Nudges:** Dilengkapi dengan estimasi waktu pengisian (± 3 Menit) dan fitur *Viral Loop* (Bagikan ke WhatsApp) untuk meningkatkan partisipasi.
- **High Performance Engine:** Berjalan di atas **FrankenPHP** dan **Laravel Octane** (Worker Mode) untuk respon server yang instan.
- **Hot Reload Development:** Dukungan penuh untuk *real-time updates* saat pengembangan menggunakan Vite dan Octane Watch mode.

## 🛠️ Teknologi (High-Performance Stack)

- **Runtime:** [FrankenPHP](https://frankenphp.dev/) (Modern PHP App Server)
- **Engine:** [Laravel 13.0](https://laravel.com/docs/13.x) + [Laravel Octane](https://laravel.com/docs/13.x/octane)
- **Frontend:** Tailwind CSS, Alpine.js, Vite
- **Infrastructure:** Docker & Docker Compose (Separated Dev/Prod configs)

## ⚙️ Panduan Instalasi Cepat (Docker)

Aplikasi ini sudah dioptimalkan menggunakan Docker. Anda tidak perlu menginstal PHP, MySQL, atau Node.js secara manual di komputer Anda.

1. **Clone Repositori:**
   ```bash
   git clone https://github.com/ipds6104/si-eco.git
   cd si-eco
   ```

2. **Jalankan Setup Otomatis:**
   Gunakan script `init.sh` untuk melakukan instalasi semua dependensi, setup database, dan menyalakan server sekaligus.
   ```bash
   chmod +x init.sh
   ./init.sh
   ```

3. **Mode Pengembangan (Hot Reload):**
   Gunakan flag `--watch` untuk mengaktifkan fitur *Auto-Reload* saat Anda mengubah kode (PHP, Blade, atau CSS).
   ```bash
   ./init.sh --watch
   ```

4. **Akses Aplikasi:**
   - **Aplikasi Utama:** [http://127.0.0.1:8100](http://127.0.0.1:8100)
   - **Formulir Kuesioner:** [http://127.0.0.1:8100/isi-kuesioner](http://127.0.0.1:8100/isi-kuesioner)

## 🐳 Manajemen Environment

Proyek ini menggunakan dua konfigurasi Docker Compose untuk menjaga keamanan produksi:
- **`docker-compose.yml`**: Konfigurasi bersih untuk **Produksi**. Tidak mengandung *volume mapping* kode sumber.
- **`docker-compose.dev.yml`**: Konfigurasi khusus **Development**. Memetakan folder lokal ke container dan mengaktifkan fitur *Watch*.

---
© 2026 CAIKUE Team - BPS Kabupaten Mempawah.
