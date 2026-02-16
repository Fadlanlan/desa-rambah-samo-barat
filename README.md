# Sistem Informasi Desa (SID) - Rambah Samo Barat

Sistem Informasi Desa modern yang dirancang untuk meningkatkan transparansi, efisiensi pelayanan, dan keterlibatan masyarakat di Desa Rambah Samo Barat.

## Fitur Utama

- 🏠 **Landing Page Kontemporer**: Menampilkan berita terbaru, galeri, dan profil desa.
- 👥 **Manajemen Kependudukan**: Dashboard statistik demografi real-time dan pengelolaan data warga.
- 📄 **Layanan Surat Digital**: Pengajuan surat online dengan verifikasi QR Code dan output PDF otomatis.
- 📢 **Aduan Warga (Lapor!)**: Sistem tiket pengaduan transparan dengan bukti foto dan pelacakan status.
- 🕒 **Antrian Online**: Booking jadwal kunjungan desa untuk menghindari kerumunan.
- 🛡️ **Audit & Keamanan**: Pencatatan aktivitas sistem yang ketat untuk akuntabilitas.

## Teknologi

- **Framework**: Laravel 10+
- **Styling**: Tailwind CSS & Alpine.js
- **Database**: MySQL/PostgreSQL
- **Tools**: Spatie Activity Log, DomPDF, Simple Qrcode

## Instalasi

1. Clone repositori ini.
2. Jalankan `composer install` & `npm install`.
3. Salin `.env.example` ke `.env` dan sesuaikan konfigurasi database.
4. Jalankan `php artisan key:generate`.
5. Jalankan migrasi dan seeder: `php artisan migrate --seed`.
6. Jalankan server: `php artisan serve` & `npm run dev`.

---
*Dikembangkan dengan ❤️ untuk Desa Rambah Samo Barat.*
