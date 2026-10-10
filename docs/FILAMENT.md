# Bonus: Filament Admin Panel (opsional)

Ikuti versi terbaru di https://filamentphp.com/docs — langkah umumnya:

```bash
composer require filament/filament
php artisan filament:install --panels      # panel id: admin  → akses di /admin
```

Batasi panel hanya untuk role admin — di `app/Models/User.php`:

```php
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    // ...
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isAdmin();   // dari trait HasShop
    }
}
```

Buat resource untuk produk & kategori:

```bash
php artisan make:filament-resource Product --generate
php artisan make:filament-resource Category --generate
```

Catatan: path `/admin` dipakai Filament, sedangkan tugas ini memakai `/admin/dashboard`.
Kalau bentrok, ubah path panel di `app/Providers/Filament/AdminPanelProvider.php`
(mis. `->path('panel')`).
