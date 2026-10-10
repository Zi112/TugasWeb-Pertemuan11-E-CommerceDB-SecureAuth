<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Post::class);

        $posts = Post::with('author')->latest()->latest('id')->paginate(8); // eager loading: cegah N+1

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        Gate::authorize('create', Post::class);

        return view('posts.create');
    }

    public function store(PostRequest $request) // otorisasi 'create' ada di PostRequest::authorize()
    {
        $request->user()->posts()->create($request->validated());

        return redirect()->route('posts.index')->with('success', 'Artikel berhasil dibuat.');
    }

    public function show(Post $post)
    {
        Gate::authorize('view', $post);

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        Gate::authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post) // otorisasi 'update' ada di PostRequest::authorize()
    {
        $post->update($request->validated());

        return redirect()->route('posts.show', $post)->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
