@csrf
<div>
    <x-input-label for="title" value="Judul" />
    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                  :value="old('title', $post->title ?? '')" required />
    <x-input-error :messages="$errors->get('title')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="body" value="Isi" />
    <textarea id="body" name="body" rows="8"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
              required>{{ old('body', $post->body ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('body')" class="mt-2" />
</div>

<div class="mt-6 flex items-center gap-3">
    <x-primary-button>{{ $submit }}</x-primary-button>
    <a href="{{ route('posts.index') }}" class="text-sm text-gray-600 hover:underline">Batal</a>
</div>
