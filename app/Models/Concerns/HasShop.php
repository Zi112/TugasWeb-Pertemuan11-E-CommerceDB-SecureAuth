<?php

namespace App\Models\Concerns;

use App\Models\Address;
use App\Models\Order;
use App\Models\Post;
use App\Models\Review;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait untuk model User: helper role + relationship e-commerce.
 * Pasang di App\Models\User dengan:  use HasShop;
 */
trait HasShop
{
    public const ROLE_ADMIN  = 'admin';
    public const ROLE_EDITOR = 'editor';
    public const ROLE_USER   = 'user';

    public function hasRole(string ...$roles): bool
    {
        return in_array($this->role, $roles, true);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole(self::ROLE_ADMIN);
    }

    public function isEditor(): bool
    {
        return $this->hasRole(self::ROLE_EDITOR);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
