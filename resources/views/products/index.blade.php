@extends('layouts.shop')
@section('title', 'Katalog Produk')

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <h1 class="text-2xl font-bold">Katalog Produk</h1>
        <form method="GET" class="flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk…"
                   class="rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <button class="rounded-md bg-gray-800 px-4 py-2 text-sm text-white hover:bg-gray-700">Cari</button>
        </form>
    </div>

    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
        @forelse ($products as $product)
            <div class="flex flex-col rounded-xl bg-white p-4 shadow-sm">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
     loading="lazy"
     class="mb-3 h-40 w-full rounded-lg object-cover">
                <span class="mb-2 w-fit rounded-full bg-indigo-50 px-2 py-0.5 text-xs text-indigo-600">{{ $product->category->name }}</span>
                <h3 class="flex-1 font-semibold">{{ $product->name }}</h3>
                <p class="mt-2 text-lg font-bold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="mt-1 text-xs text-gray-500">
                    ⭐ {{ $product->reviews_avg_rating ? number_format($product->reviews_avg_rating, 1) : '-' }}
                    ({{ $product->reviews_count }} ulasan) · stok {{ $product->stock }}
                </p>
            </div>
        @empty
            <p class="col-span-full py-16 text-center text-gray-400">Produk tidak ditemukan.</p>
        @endforelse
    </div>

    <div class="mt-8">{{ $products->links() }}</div>
@endsection
