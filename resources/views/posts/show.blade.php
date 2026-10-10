<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $post->title }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 rounded-md bg-green-100 px-4 py-3 text-sm text-green-800">{{ session('success') }}</div>
            @endif

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <p class="mb-4 text-xs text-gray-400">oleh {{ $post->author->name }} · {{ $post->created_at->format('d M Y H:i') }}</p>
                <div class="whitespace-pre-line leading-relaxed text-gray-700">{{ $post->body }}</div>

                <div class="mt-6 flex items-center gap-2 border-t pt-4">
                    <a href="{{ route('posts.index') }}" class="rounded border px-3 py-1 text-sm hover:bg-gray-50">← Kembali</a>
                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post) }}" class="rounded border px-3 py-1 text-sm hover:bg-gray-50">Edit</a>
                    @endcan
                    @can('delete', $post)
                        <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('Hapus artikel ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="rounded border border-red-300 px-3 py-1 text-sm text-red-600 hover:bg-red-50">Hapus</button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
