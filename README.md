# TugasWeb-P11-EcommerceAuth

Tugas Rutin 11 — E-Commerce DB + Secure Auth (Laravel 13 + Breeze).
Hasil pengujian otomatis: **52/52 skenario lulus** (`docs/laporan-testing-p11.md`). Breeze sudah terpasang di project ini.

## Cara menjalankan
Butuh: PHP ≥ 8.3, Composer, Node.js ≥ 20.19 (atau 22), MySQL/MariaDB.

```bash
composer install
cp .env.example .env            # Windows: copy .env.example .env
php artisan key:generate
```
1. Buat database `tugasweb_p11` di phpMyAdmin. (`APP_FAKER_LOCALE=id_ID` sudah diatur di `.env.example`.)
2. Lanjutkan:
```bash
php artisan migrate:fresh --seed
php artisan storage:link        # wajib agar foto produk tampil
npm install
npm run build                   # atau: npm run dev
php artisan serve               # http://127.0.0.1:8000
```

## Akun uji (password: `password`)
| Role | Email |
|------|-------|
| admin | admin@example.com |
| editor | editor@example.com |
| user | user@example.com |

## Bagian A — Database & Eloquent
| # | Requirement | Lokasi |
|---|-------------|--------|
| 1 | Migrations 7 tabel + FK | `database/migrations/2026_10_04_0000{02..08}_*`: `categories`, `products`, `addresses`, `orders`, `order_items`, `reviews`, `posts` (+ kolom `role` di `users`). FK dengan `restrictOnDelete` / `cascadeOnDelete` / `nullOnDelete` |
| 2 | Seeders + factories (50+ produk) | `DatabaseSeeder`: 8 kategori × 7 = **56 produk**, 13 user, 25 order, 55 review; factory Category/Product/Address/Post/Review |
| 3 | Model + relationships + scope | `app/Models/*`; scope `active()`, `inStock()`, `search()` di `Product` |
| 4 | 5 query Tinker | `docs/TINKER.md` (query) + `docs/TINKER-OUTPUT.md` (output asli). **Ambil screenshot sendiri** dari `php artisan tinker` |

## Bagian B — Auth & Security
| # | Requirement | Lokasi |
|---|-------------|--------|
| 5 | Breeze (login/register/logout) | `routes/auth.php`, `app/Http/Controllers/Auth/*`, views Breeze |
| 6 | Multi-role + custom middleware | `users.role`, `app/Http/Middleware/RoleMiddleware.php`, alias `role` di `bootstrap/app.php` |
| 7 | PostPolicy edit/delete | `app/Policies/PostPolicy.php`; dipakai `PostRequest::authorize()`, `Gate::authorize()` di `PostController`, dan `@can` di view |
| 8 | Route protection + testing 2 role | `routes/web.php` + `docs/laporan-testing-p11.md` |

Bonus: eager loading (`ProductController`, `PostController`, demo 57 vs 2 query di `docs/TINKER-OUTPUT.md`); Filament: `docs/FILAMENT.md` (belum diuji).

## Hak akses
| Halaman | Guest | user | editor | admin |
|---------|:----:|:----:|:------:|:-----:|
| `/products` | ✅ | ✅ | ✅ | ✅ |
| `/dashboard`, `/posts`, `/posts/{id}` | → login | ✅ | ✅ | ✅ |
| `/posts/create` | → login | 403 | ✅ | ✅ |
| edit / hapus artikel | → login | 403 | hanya miliknya | semua |
| `/editor/dashboard` | → login | 403 | ✅ | ✅ |
| `/admin/dashboard` | → login | 403 | 403 | ✅ |

## Testing manual incognito 2 role
1. Window biasa: login `admin@example.com`. Window incognito: login `user@example.com` (atau `editor@example.com`).
2. Buka di keduanya lalu screenshot: `/admin/dashboard`, `/posts/create`, dan `/posts/{id}/edit` milik admin. Hasil yang diharapkan ada di tabel hak akses di atas.

## Keamanan
- Kolom `role` **tidak** ada di `$fillable`; register tidak bisa menyuntik `role=admin` (diuji).
- `user_id` artikel diisi dari akun yang login, bukan dari input.
- Otorisasi dijalankan sebelum validasi (403 lebih dulu), password di-hash (bcrypt), `@csrf` pada semua form, output di-escape.
