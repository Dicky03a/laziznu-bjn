<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQurbanHewanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'jenis' => ['required', 'in:sapi,unta,kambing,domba'],
            'nama' => ['required', 'string', 'max:200'],
            'deskripsi' => ['nullable', 'string'],
            'berat_estimasi' => ['nullable', 'string', 'max:50'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'harga_total' => ['required', 'integer', 'min:100000'],
            'is_active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'jenis.required' => 'Pilih jenis hewan.',
            'jenis.in' => 'Jenis hewan tidak valid.',
            'nama.required' => 'Nama hewan wajib diisi.',
            'harga_total.required' => 'Harga hewan wajib diisi.',
            'harga_total.min' => 'Harga minimal Rp 100.000.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
