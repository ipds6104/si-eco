# CAIKUE Project Intelligence (Gemini Context)

Dokumen ini berisi konteks strategis, keputusan arsitektur, dan panduan desain untuk membantu asisten AI (Gemini/Antigravity) memahami arah proyek ini.

## 🎯 Visi & Branding
- **Nama Proyek:** CAIKUE (Catatan Industri dan Kuesioner Ekonomi Digital).
- **Tujuan Utama:** Mitigasi *undercoverage* Sensus Ekonomi 2026. Mencari pelaku usaha yang belum terdata di lapangan.
- **Terminologi Resmi:** Gunakan selalu "**Identifikasi dan Pemetaan**". Hindari kata "Survei" untuk menghindari beban administrasi/hukum formal BPS.
- **Target Audiens:** Responden publik (melalui WhatsApp) dan Admin internal BPS.

## 🎨 Prinsip UX/UI
- **Mobile-First:** Prioritaskan tampilan *smartphone*. Gunakan jempol sebagai navigasi utama.
- **Card-Based Inputs:** Hindari input radio/checkbox standar browser. Gunakan sistem `card-input` (pilihan dalam bentuk kartu) untuk memudahkan klik di HP.
- **Psychological Nudges:** 
    - Selalu ingatkan bahwa estimasi waktu pengisian adalah **± 3 Menit**.
    - Gunakan *Viral Loop* di halaman sukses (Bagikan ke WhatsApp).
    - Tanda bintang wajib isi (`*`) harus berwarna merah (`text-danger`).

## 🛠️ Arsitektur Teknis
- **Laravel Octane (FrankenPHP):** Aplikasi berjalan dalam mode *Worker*. Perubahan pada `.env` atau *Class* tertentu mungkin memerlukan *reload* container.
- **Hot Reload:** Diaktifkan melalui `./init.sh --watch`. Ini menjalankan `npm run dev` dan `octane:start --watch` secara bersamaan.
- **Docker Security:** 
    - `docker-compose.yml` (Produksi) **TIDAK BOLEH** memiliki volume mapping ke folder lokal (`. : /app`) untuk menjaga keamanan integritas kode.
    - `docker-compose.dev.yml` (Development) memetakan folder lokal untuk kemudahan koding.

## 📝 Catatan Penting (AI Instructions)
- **Data Redundancy:** Jangan menambahkan pertanyaan identitas (Nama, Status, dll) di lebih dari satu tempat. Jika sudah ada di skrining, jangan diulangi di bagian identitas.
- **Form Validation:** Gunakan SweetAlert2 untuk semua notifikasi sukses/error agar terlihat premium.
- **Performance:** Pastikan semua gambar di- *serve* dalam format modern (WebP) jika memungkinkan.

---
*Dokumen ini diperbarui terakhir kali pada April 2026.*
