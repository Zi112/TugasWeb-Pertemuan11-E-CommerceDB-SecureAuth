<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-900">
                Halo, <strong>{{ auth()->user()->name }}</strong>! Role kamu:
                <span class="ml-1 rounded-full bg-indigo-100 px-3 py-0.5 text-sm font-semibold text-indigo-700">{{ auth()->user()->role }}</span>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-900">
                <h3 class="mb-3 font-semibold">Menu sesuai role</h3>
                <ul class="list-disc space-y-1 pl-5">
                    <li><a class="text-indigo-600 underline" href="{{ route('posts.index') }}">Daftar Artikel</a> (semua role)</li>
                    <li><a class="text-indigo-600 underline" href="{{ route('products.index') }}">Katalog Produk</a> (publik)</li>
                    @if (auth()->user()->hasRole('admin', 'editor'))
                        <li><a class="text-indigo-600 underline" href="{{ route('editor.dashboard') }}">Dashboard Editor</a> (admin &amp; editor)</li>
                    @endif
                    @if (auth()->user()->isAdmin())
                        <li><a class="text-indigo-600 underline" href="{{ route('admin.dashboard') }}">Dashboard Admin</a> (admin)</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
