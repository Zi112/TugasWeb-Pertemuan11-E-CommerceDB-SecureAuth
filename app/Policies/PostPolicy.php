<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /** Semua user yang login boleh melihat artikel. */
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Post $post): bool
    {
        return true;
    }

    /** Hanya admin & editor yang boleh membuat artikel. */
    public function create(User $user): bool
    {
        return $user->hasRole('admin', 'editor');
    }

    /** Admin: semua artikel. Editor: hanya artikel miliknya. User biasa: tidak boleh. */
    public function update(User $user, Post $post): bool
    {
        return $user->isAdmin()
            || ($user->isEditor() && $user->id === $post->user_id);
    }

    public function delete(User $user, Post $post): bool
    {
        return $this->update($user, $post);
    }
}
