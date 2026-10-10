# Hasil Eksekusi 5 Query Tinker (output asli)

Dijalankan pada database hasil `php artisan migrate:fresh --seed` (Laravel 13, MariaDB 10.11). Nilai stok/ID bisa berbeda di komputermu karena data seeder memakai angka acak. Screenshot sendiri tetap perlu diambil dari `php artisan tinker`.

## 1. Scope active() + inStock()
```php
Product::active()->inStock()->orderByDesc('price')->take(5)->get(['id','name','price','stock']);
```
```json
[
    {
        "id": 1,
        "name": "Smartphone Android 8\/256GB",
        "price": "3499000.00",
        "stock": 2
    },
    {
        "id": 4,
        "name": "Smartwatch Layar AMOLED",
        "price": "649000.00",
        "stock": 170
    },
    {
        "id": 28,
        "name": "Dispenser Air Galon Bawah",
        "price": "549000.00",
        "stock": 157
    },
    {
        "id": 7,
        "name": "Keyboard Mekanik 87 Key",
        "price": "459000.00",
        "stock": 52
    },
    {
        "id": 23,
        "name": "Set Panci Anti Lengket 5 Pcs",
        "price": "399000.00",
        "stock": 106
    }
]
```

## 2. Relationship + eager loading
```php
Product::with('category')->take(5)->get()->map(fn ($p) => [$p->name, $p->category->name]);
```
```json
[
    [
        "Smartphone Android 8\/256GB",
        "Elektronik"
    ],
    [
        "Earbuds Bluetooth TWS",
        "Elektronik"
    ],
    [
        "Power Bank 20.000 mAh",
        "Elektronik"
    ],
    [
        "Smartwatch Layar AMOLED",
        "Elektronik"
    ],
    [
        "Speaker Bluetooth Portabel",
        "Elektronik"
    ]
]
```

## 3. withCount — produk per kategori
```php
Category::withCount('products')->get(['id','name']);
```
```json
[
    {
        "id": 1,
        "name": "Elektronik",
        "slug": "elektronik",
        "created_at": "2026-10-04T14:16:52.000000Z",
        "updated_at": "2026-10-04T14:16:52.000000Z",
        "products_count": 7
    },
    {
        "id": 2,
        "name": "Fashion Pria",
        "slug": "fashion-pria",
        "created_at": "2026-10-04T14:16:52.000000Z",
        "updated_at": "2026-10-04T14:16:52.000000Z",
        "products_count": 7
    },
    {
        "id": 3,
        "name": "Fashion Wanita",
        "slug": "fashion-wanita",
        "created_at": "2026-10-04T14:16:52.000000Z",
        "updated_at": "2026-10-04T14:16:52.000000Z",
        "products_count": 7
    },
    {
        "id": 4,
        "name": "Rumah Tangga",
        "slug": "rumah-tangga",
        "created_at": "2026-10-04T14:16:52.000000Z",
        "updated_at": "2026-10-04T14:16:52.000000Z",
        "products_count": 7
    },
    {
        "id": 5,
        "name": "Buku & Alat Tulis",
        "slug": "buku-alat-tulis",
        "created_at": "2026-10-04T14:16:52.000000Z",
        "updated_at": "2026-10-04T14:16:52.000000Z",
        "products_count": 7
    },
    {
        "id": 6,
        "name": "Olahraga",
        "slug": "olahraga",
        "created_at": "2026-10-04T14:16:52.000000Z",
        "updated_at": "2026-10-04T14:16:52.000000Z",
        "products_count": 7
    },
    {
        "id": 7,
        "name": "Kecantikan",
        "slug": "kecantikan",
        "created_at": "2026-10-04T14:16:52.000000Z",
        "updated_at": "2026-10-04T14:16:52.000000Z",
        "products_count": 7
    },
    {
        "id": 8,
        "name": "Makanan & Minuman",
        "slug": "makanan-minuman",
        "created_at": "2026-10-04T14:16:52.000000Z",
        "updated_at": "2026-10-04T14:16:52.000000Z",
        "products_count": 7
    }
]
```

## 4. Nested relationship — order terbaru
```php
Order::with(['user:id,name','items.product:id,name'])->latest()->first();
```
```json
{
    "id": 25,
    "user_id": 3,
    "address_id": 11,
    "order_number": "INV-1FRNQESC",
    "status": "completed",
    "total": "1336000.00",
    "created_at": "2026-10-04T14:16:52.000000Z",
    "updated_at": "2026-10-04T14:16:52.000000Z",
    "user": {
        "id": 3,
        "name": "Pembeli Uji"
    },
    "items": [
        {
            "id": 56,
            "order_id": 25,
            "product_id": 12,
            "quantity": 3,
            "price": "299000.00",
            "created_at": "2026-10-04T14:16:52.000000Z",
            "updated_at": "2026-10-04T14:16:52.000000Z",
            "product": {
                "id": 12,
                "name": "Sepatu Sneakers Kanvas"
            }
        },
        {
            "id": 57,
            "order_id": 25,
            "product_id": 48,
            "quantity": 3,
            "price": "69000.00",
            "created_at": "2026-10-04T14:16:52.000000Z",
            "updated_at": "2026-10-04T14:16:52.000000Z",
            "product": {
                "id": 48,
                "name": "Masker Kain Sheet (Isi 10)"
            }
        },
        {
            "id": 58,
            "order_id": 25,
            "product_id": 49,
            "quantity": 3,
            "price": "52000.00",
            "created_at": "2026-10-04T14:16:52.000000Z",
            "updated_at": "2026-10-04T14:16:52.000000Z",
            "product": {
                "id": 49,
                "name": "Shampoo Anti Ketombe 340ml"
            }
        },
        {
            "id": 59,
            "order_id": 25,
            "product_id": 56,
            "quantity": 2,
            "price": "38000.00",
            "created_at": "2026-10-04T14:16:52.000000Z",
            "updated_at": "2026-10-04T14:16:52.000000Z",
            "product": {
                "id": 56,
                "name": "Cokelat Batang Dark 70% 100g"
            }
        }
    ]
}
```

## 5. withAvg — rating rata-rata tertinggi
```php
Product::withAvg('reviews','rating')->withCount('reviews')->orderByDesc('reviews_avg_rating')->take(5)->get(['id','name'])->map(fn ($p) => [$p->name, round($p->reviews_avg_rating, 2), $p->reviews_count]);
```
```json
[
    [
        "Smartphone Android 8\/256GB",
        5,
        1
    ],
    [
        "Smartwatch Layar AMOLED",
        5,
        1
    ],
    [
        "Keyboard Mekanik 87 Key",
        5,
        1
    ],
    [
        "Celana Chino Slim Fit",
        5,
        2
    ],
    [
        "Set Panci Anti Lengket 5 Pcs",
        5,
        1
    ]
]
```

## Bonus — N+1 vs eager loading
```php
DB::enableQueryLog(); Product::all()->each(fn ($p) => $p->category->name); count(DB::getQueryLog());
```
Tanpa eager loading: 57 query

Dengan with('category'): 2 query
