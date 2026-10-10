# Laporan Testing — Tugas Rutin 11 (E-Commerce DB + Secure Auth)

**Hasil: 52/52 lulus**

Lingkungan uji: Laravel 13.34, PHP 8.3.6, MariaDB 10.11, uji otomatis lewat HTTP (server `php artisan serve`, sesi terpisah per role).

Database dibuat ulang dengan `migrate:fresh --seed`. Akun: admin / editor / user (password: `password`). Pengujian 3 sesi terpisah menggantikan skenario incognito. Build aset: `npm install && npm run build` berhasil (Vite + Tailwind).

| # | Skenario | Hasil |
|---|----------|-------|
| 1 | Guest /dashboard -> redirect login | ✅ |
| 2 | Guest /posts -> redirect login | ✅ |
| 3 | Guest /posts/create -> redirect login | ✅ |
| 4 | Guest /admin/dashboard -> redirect login | ✅ |
| 5 | Guest /editor/dashboard -> redirect login | ✅ |
| 6 | Guest /profile -> redirect login | ✅ |
| 7 | Guest /products publik 200 | ✅ |
| 8 | Katalog 12 produk/halaman 12 | ✅ |
| 9 | Katalog menampilkan rating & badge kategori | ✅ |
| 10 | Pencarian produk | ✅ |
| 11 | Login password salah ditolak | ✅ |
| 12 | Admin login -> /dashboard | ✅ |
| 13 | Admin /dashboard 200 + role tampil | ✅ |
| 14 | Admin /admin/dashboard 200 | ✅ |
| 15 | Admin statistik produk = 56 | ✅ |
| 16 | Admin /editor/dashboard 200 | ✅ |
| 17 | Admin /posts/create 200 | ✅ |
| 18 | Admin melihat Edit utk semua 5 artikel | ✅ |
| 19 | Editor login | ✅ |
| 20 | Editor /admin/dashboard 403 | ✅ |
| 21 | Editor /editor/dashboard 200 | ✅ |
| 22 | Editor hanya melihat Edit utk artikel miliknya ['1', '2', '3'] vs ['1', '2', '3'] | ✅ |
| 23 | Editor edit artikel sendiri 200 | ✅ |
| 24 | Editor edit artikel ORANG LAIN 403 | ✅ |
| 25 | Editor update artikel orang lain 403 | ✅ |
| 26 | Editor update orang lain + data invalid tetap 403 (otorisasi dulu) | ✅ |
| 27 | Editor hapus artikel orang lain 403 | ✅ |
| 28 | Artikel orang lain tidak berubah/terhapus | ✅ |
| 29 | Validasi artikel (Form Request) | ✅ |
| 30 | Editor buat artikel sukses | ✅ |
| 31 | XSS di-escape | ✅ |
| 32 | user_id diisi dari akun login (bukan input) | ✅ |
| 33 | Editor hapus artikel sendiri sukses | ✅ |
| 34 | User login | ✅ |
| 35 | User /posts 200 | ✅ |
| 36 | User tidak melihat tombol Edit/Hapus/Artikel Baru | ✅ |
| 37 | User /posts/create 403 | ✅ |
| 38 | User /admin/dashboard 403 | ✅ |
| 39 | User /editor/dashboard 403 | ✅ |
| 40 | User /posts/4/edit 403 | ✅ |
| 41 | User POST /posts 403 | ✅ |
| 42 | User POST invalid tetap 403 | ✅ |
| 43 | User DELETE artikel 403 | ✅ |
| 44 | Tidak ada data dari user nakal | ✅ |
| 45 | User boleh membaca artikel (show 200) | ✅ |
| 46 | Dashboard user tidak menampilkan menu admin | ✅ |
| 47 | Register berhasil | ✅ |
| 48 | Role user baru = user (tidak bisa disuntik role=admin) | ✅ |
| 49 | Password tersimpan sebagai hash | ✅ |
| 50 | User baru ditolak ke /admin/dashboard | ✅ |
| 51 | Logout | ✅ |
| 52 | Setelah logout /admin/dashboard -> login | ✅ |
