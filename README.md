# fixHosting

Struktur aplikasi disiapkan agar bisa langsung diletakkan di folder web root (mis. `htdocs` di shared hosting seperti InfinityFree).

## Jalankan secara lokal
1. Pastikan server web Anda mengarah ke direktori proyek ini (file `index.php` ada di root proyek).
2. Salin `.sql` dan konfigurasi database sesuai kebutuhan, lalu sesuaikan kredensial di `config/config.php`.
3. Atur `BASE_URL` di `config/config.php` bila deteksi otomatis tidak sesuai (contoh: `http://localhost/fixHosting/`).
4. Akses lewat browser: `http://localhost/fixHosting/`.

## Deploy ke InfinityFree
1. Unggah seluruh isi repo ke folder `htdocs/`:
   - `index.php`, `login.php`, `logout.php` di root `htdocs`.
   - Folder `app/` dan `config/` tetap di root.
   - Aset statis tetap di `public/assets/`.
2. Edit `config/config.php` untuk menyesuaikan kredensial database dan nilai `BASE_URL` (mis. `https://yourdomain/`).
3. Buka domain hosting Anda, aplikasi siap digunakan.