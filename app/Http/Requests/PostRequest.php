<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Otorisasi (PostPolicy) + validasi untuk store & update artikel.
 * Otorisasi dijalankan lebih dulu, sehingga user tanpa hak selalu mendapat 403
 * (bukan pesan validasi).
 */
class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        $post = $this->route('post');   // null saat store, model Post saat update

        return $post instanceof Post
            ? $this->user()->can('update', $post)
            : $this->user()->can('create', Post::class);
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:150'],
            'body'  => ['required', 'string', 'min:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul wajib diisi.',
            'title.min'      => 'Judul minimal :min karakter.',
            'body.required'  => 'Isi artikel wajib diisi.',
            'body.min'       => 'Isi artikel minimal :min karakter.',
        ];
    }
}
