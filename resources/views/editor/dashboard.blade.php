<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard Editor</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="font-semibold text-gray-800">Artikel saya ({{ $myPosts->count() }})</h3>
                <a href="{{ route('posts.create') }}" class="rounded-md bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700">+ Artikel Baru</a>
            </div>

            <div class="overflow-hidden rounded-lg bg-white shadow-sm">
                <ul class="divide-y">
                    @forelse ($myPosts as $post)
                        <li class="flex items-center justify-between px-5 py-3">
                            <a class="text-indigo-600 hover:underline" href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                            <span class="text-xs text-gray-400">{{ $post->created_at->format('d M Y') }}</span>
                        </li>
                    @empty
                        <li class="px-5 py-8 text-center text-gray-400">Belum ada artikel.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
