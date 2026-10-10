<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Category;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===== 1. Akun uji untuk 3 role (password semua: "password") =====
        $admin  = User::factory()->create(['name' => 'Admin Toko',  'email' => 'admin@example.com',  'role' => 'admin']);
        $editor = User::factory()->create(['name' => 'Editor Toko', 'email' => 'editor@example.com', 'role' => 'editor']);
        $buyer  = User::factory()->create(['name' => 'Pembeli Uji', 'email' => 'user@example.com',   'role' => 'user']);

        $customers = User::factory(10)->create(['role' => 'user'])->push($buyer);

        // ===== 2. Kategori + 56 produk realistis =====
        $catalog = [
            'Elektronik' => [
                ['Smartphone Android 8/256GB', 3499000], ['Earbuds Bluetooth TWS', 189000],
                ['Power Bank 20.000 mAh', 235000],       ['Smartwatch Layar AMOLED', 649000],
                ['Speaker Bluetooth Portabel', 275000],  ['Mouse Wireless Silent Click', 99000],
                ['Keyboard Mekanik 87 Key', 459000],
            ],
            'Fashion Pria' => [
                ['Kaos Polos Katun Combed 30s', 65000],  ['Kemeja Flanel Lengan Panjang', 159000],
                ['Celana Chino Slim Fit', 189000],       ['Jaket Bomber Water Resistant', 275000],
                ['Sepatu Sneakers Kanvas', 299000],      ['Topi Baseball Polos', 49000],
                ['Ikat Pinggang Kulit Sintetis', 85000],
            ],
            'Fashion Wanita' => [
                ['Blouse Rayon Motif Bunga', 129000],    ['Rok Plisket Panjang', 119000],
                ['Hijab Segi Empat Voal', 59000],        ['Dress Casual Katun', 175000],
                ['Tas Selempang Kulit Sintetis', 225000],['Flat Shoes Nyaman', 149000],
                ['Cardigan Rajut Oversize', 139000],
            ],
            'Rumah Tangga' => [
                ['Rice Cooker 1,8 Liter', 349000],       ['Set Panci Anti Lengket 5 Pcs', 399000],
                ['Blender Kaca 1,5 Liter', 289000],      ['Sapu & Pengki Set', 45000],
                ['Lampu LED 12 Watt (Isi 3)', 69000],    ['Organizer Plastik Susun', 89000],
                ['Dispenser Air Galon Bawah', 549000],
            ],
            'Buku & Alat Tulis' => [
                ['Buku Tulis Sidu 38 Lembar (Isi 10)', 39000], ['Pulpen Gel 0.5mm (Isi 12)', 36000],
                ['Novel Fiksi Indonesia Best Seller', 89000],  ['Stabilo Highlighter Set 6 Warna', 55000],
                ['Kalkulator Ilmiah 240 Fungsi', 175000],      ['Binder A5 + Refill', 65000],
                ['Buku Pemrograman Dasar PHP & MySQL', 125000],
            ],
            'Olahraga' => [
                ['Matras Yoga TPE 6mm', 119000],         ['Dumbbell Vinyl 5 Kg (Sepasang)', 175000],
                ['Sepatu Lari Ringan', 399000],          ['Botol Minum Olahraga 1 Liter', 59000],
                ['Raket Badminton Karbon', 249000],      ['Bola Futsal Ukuran 4', 135000],
                ['Skipping Rope Speed Jump', 39000],
            ],
            'Kecantikan' => [
                ['Facial Wash Gentle 100ml', 45000],     ['Sunscreen SPF 50 PA++++', 79000],
                ['Serum Vitamin C 20ml', 99000],         ['Pelembap Wajah Ceramide', 85000],
                ['Lip Tint Matte', 55000],               ['Masker Kain Sheet (Isi 10)', 69000],
                ['Shampoo Anti Ketombe 340ml', 52000],
            ],
            'Makanan & Minuman' => [
                ['Kopi Arabika Gayo 250g', 89000],       ['Teh Hijau Celup (Isi 50)', 35000],
                ['Madu Hutan Murni 500ml', 115000],      ['Keripik Singkong Balado 200g', 22000],
                ['Granola Oat Madu 400g', 68000],        ['Sambal Teri Botol 180g', 32000],
                ['Cokelat Batang Dark 70% 100g', 38000],
            ],
        ];

        foreach ($catalog as $categoryName => $items) {
            $category = Category::factory()->create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
            ]);

            foreach ($items as [$name, $price]) {
                Product::factory()->create([
                    'category_id' => $category->id,
                    'name'        => $name,
                    'slug'        => Str::slug($name),
                    'price'       => $price,
                    'is_active'   => true,
                    'image'       => (($found = glob(storage_path('app/public/products/' . Str::slug($name) . '.*'))) && $found)
                    ? 'products/' . basename($found[0])
                    : 'https://picsum.photos/seed/' . Str::slug($name) . '/600/450',
                ]);
            }
        }

        $products = Product::all();

        // ===== 3. Alamat, order + item, review =====
        foreach ($customers as $customer) {
            $address = Address::factory()->create(['user_id' => $customer->id]);

            foreach (range(1, random_int(1, 3)) as $_) {
                $order = Order::create([
                    'user_id'      => $customer->id,
                    'address_id'   => $address->id,
                    'order_number' => 'INV-' . strtoupper(Str::random(8)),
                    'status'       => fake()->randomElement(['pending', 'paid', 'shipped', 'completed']),
                    'total'        => 0,
                ]);

                $total = 0;
                foreach ($products->random(random_int(1, 4)) as $product) {
                    $qty = random_int(1, 3);
                    $order->items()->create([
                        'product_id' => $product->id,
                        'quantity'   => $qty,
                        'price'      => $product->price,
                    ]);
                    $total += $qty * $product->price;
                }
                $order->update(['total' => $total]);
            }

            foreach ($products->random(5) as $product) {
                Review::factory()->create([
                    'user_id'    => $customer->id,
                    'product_id' => $product->id,
                ]);
            }
        }

        // ===== 4. Artikel =====
        Post::factory(3)->create(['user_id' => $editor->id]);
        Post::factory(2)->create(['user_id' => $admin->id]);
    }
}
