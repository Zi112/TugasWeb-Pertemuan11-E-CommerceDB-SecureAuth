# Dokumentasi 5 Query Tinker

Jalankan `php artisan tinker`, ketik query di bawah, lalu **screenshot** tiap hasilnya
dan simpan di folder `docs/` (mis. `tinker-1.png` … `tinker-5.png`).

## 1. Scope — produk aktif & ada stok, termahal
```php
Product::active()->inStock()->orderByDesc('price')->take(5)->get(['id', 'name', 'price', 'stock']);
```
Menunjukkan penggunaan **scope** `active()` dan `inStock()` yang bisa dirantai.

## 2. Relationship — produk beserta kategorinya (eager loading)
```php
Product::with('category')->take(5)->get()->map(fn ($p) => [$p->name, $p->category->name]);
```
`with('category')` memuat kategori sekaligus (2 query), bukan 1 query per produk.

## 3. Aggregate — jumlah produk per kategori
```php
Category::withCount('products')->get(['id', 'name']);
```
Hasil memiliki atribut `products_count`.

## 4. Nested relationship — order terbaru beserta pembeli dan itemnya
```php
Order::with(['user:id,name', 'items.product:id,name'])->latest()->first();
```
Menampilkan relasi bertingkat: `Order → items → product`.

## 5. Aggregate relasi — 5 produk dengan rating rata-rata tertinggi
```php
Product::withAvg('reviews', 'rating')->withCount('reviews')
    ->orderByDesc('reviews_avg_rating')->take(5)
    ->get(['id', 'name'])->map(fn ($p) => [$p->name, round($p->reviews_avg_rating, 2), $p->reviews_count]);
```

---

## Bonus — Demo eager loading (N+1 vs eager)
```php
use Illuminate\Support\Facades\DB;

// TANPA eager loading → 1 + N query
DB::flushQueryLog(); DB::enableQueryLog();
Product::all()->each(fn ($p) => $p->category->name);
count(DB::getQueryLog());      // ≈ 57 (1 + 56 produk)

// DENGAN eager loading → 2 query
DB::flushQueryLog();
Product::with('category')->get()->each(fn ($p) => $p->category->name);
count(DB::getQueryLog());      // 2
```
Screenshot kedua angka tersebut sebagai bukti.
