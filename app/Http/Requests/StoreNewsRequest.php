<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:news',
            'category_id' => 'nullable|exists:categories,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'published_at' => 'nullable|date',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Judul harus diisi',
            'title.max' => 'Judul tidak boleh lebih dari 255 karakter',
            'slug.required' => 'Slug harus diisi',
            'slug.unique' => 'Slug sudah digunakan',
            'category_id.exists' => 'Kategori tidak valid',
            'featured_image.image' => 'Featured image harus berupa gambar',
            'featured_image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
            'content.required' => 'Konten harus diisi',
            'excerpt.max' => 'Excerpt tidak boleh lebih dari 500 karakter',
            'published_at.date' => 'Format tanggal tidak valid',
        ];
    }
}
