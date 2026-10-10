<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Artikel</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('posts.update', $post) }}" class="bg-white p-6 shadow-sm sm:rounded-lg">
                @method('PUT')
                @include('posts._form', ['submit' => 'Perbarui'])
            </form>
        </div>
    </div>
</x-app-layout>
