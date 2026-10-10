<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Artikel Toko</h2>
            @can('create', App\Models\Post::class)
                <a href="{{ route('posts.create') }}" class="rounded-md bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700">+ Artikel Baru</a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 rounded-md bg-green-100 px-4 py-3 text-sm text-green-800">{{ session('success') }}</div>
            @endif

            <div class="space-y-4">
                @forelse ($posts as $post)
                    <div class="rounded-lg bg-white p-5 shadow-sm">
                        <a href="{{ route('posts.show', $post) }}" class="text-lg font-semibold text-gray-900 hover:text-indigo-600">{{ $post->title }}</a>
                        <p class="mt-1 text-xs text-gray-400">oleh {{ $post->author->name }} · {{ $post->created_at->format('d M Y') }}</p>
                        <p class="mt-2 text-sm text-gray-600">{{ \Illuminate\Support\Str::limit($post->body, 140) }}</p>

                        <div class="mt-3 flex gap-2">
                            @can('update', $post)
                                <a href="{{ route('posts.edit', $post) }}" class="rounded border px-3 py-1 text-xs hover:bg-gray-50">Edit</a>
                            @endcan
                            @can('delete', $post)
                                <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('Hapus artikel ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded border border-red-300 px-3 py-1 text-xs text-red-600 hover:bg-red-50">Hapus</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                @empty
                    <p class="py-12 text-center text-gray-400">Belum ada artikel.</p>
                @endforelse
            </div>

            <div class="mt-6">{{ $posts->links() }}</div>
        </div>
    </div>
</x-app-layout>
