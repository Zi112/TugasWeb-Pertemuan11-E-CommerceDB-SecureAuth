<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'sku', 'name', 'slug', 'description', 'price', 'stock', 'is_active', 'image',
        ];

    protected function casts(): array
    {
        return [
            'price'     => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }
    protected function imageUrl(): Attribute
    {
        return Attribute::get(function () {
            if (! $this->image) {
                return 'https://placehold.co/600x450?text=' . urlencode($this->name);
            }

            return Str::startsWith($this->image, ['http://', 'https://'])
                ? $this->image
                : asset('storage/' . $this->image);
        });
    }
    
    /* ---------- Relationships ---------- */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /* ---------- Scopes ---------- */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeInStock(Builder $query): Builder
    {
        return $query->where('stock', '>', 0);
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        return $query->when($term, fn (Builder $q) => $q->where('name', 'like', "%{$term}%"));
    }
}
