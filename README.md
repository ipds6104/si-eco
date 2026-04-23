# CAIKUE (Catatan Industri dan Kuesioner Ekonomi Digital)

Aplikasi manajemen kuesioner dan pendataan industri digital yang dioptimalkan untuk performa tinggi dan kemudahan distribusi. **CAIKUE** dirancang untuk memudahkan pengumpulan data lapangan secara publik melalui integrasi WhatsApp dan sistem formulir dinamis.

## 🚀 Fitur Unggulan

- **Public Questionnaire Access:** Kuesioner dapat diakses oleh siapa saja tanpa perlu login, memudahkan distribusi via WhatsApp.
- **WhatsApp Share Integration:** Fitur bagikan link kuesioner langsung dari Dashboard Admin.
- **Multi-Form System:** Mendukung banyak kuesioner sekaligus dengan link unik untuk setiap form.
- **High Performance Engine:** Berjalan di atas **FrankenPHP** dan **Laravel Octane** (Worker Mode) untuk respon server yang instan.
- **Dynamic Form Builder:** Buat dan sesuaikan formulir pendataan Anda sendiri melalui antarmuka admin.
- **Export Powerhouse:** Rekap data otomatis ke format **Excel** dan **PDF**.

## 🛠️ Teknologi (High-Performance Stack)

- **Runtime:** [FrankenPHP](https://frankenphp.dev/) (Modern PHP App Server)
- **Engine:** [Laravel 13](https://laravel.com/docs/13.x) + [Laravel Octane](https://laravel.com/docs/13.x/octane)
- **Frontend:** Tailwind CSS, Alpine.js, Vite
- **Infrastructure:** Docker & Docker Compose (Zero-Config Setup)

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

3. **Akses Aplikasi:**
   - **Aplikasi Utama:** [http://localhost:8100](http://localhost:8100)
   - **Public Questionnaire:** [http://localhost:8100/isi-kuesioner](http://localhost:8100/isi-kuesioner)
   - **Mail Viewer (Testing):** [http://localhost:8180](http://localhost:8180)

## 🐳 Perintah Docker yang Sering Digunakan

- **Menjalankan Server:** `docker compose up -d`
- **Melihat Log:** `docker compose logs -f app`
- **Reset Database (Fresh):** `./init.sh --fresh`
- **Masuk ke Shell Container:** `docker compose exec app bash`

## 📂 Struktur Penting
- `routes/web.php` : Definisi route publik dan admin.
- `app/Http/Controllers/KuesionerController.php` : Logic utama kuesioner Ekonomi Digital.
- `resources/views/kuesioner/` : Template antarmuka kuesioner publik.
- `docker-compose.yml` : Konfigurasi orkestrasi container (Octane & MySQL).

---
© 2026 CAIKUE Team - Dikembangkan untuk efisiensi pendataan statistik industri digital.
