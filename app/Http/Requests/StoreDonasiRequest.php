<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDonasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'jumlah' => ['required', 'integer', 'min:1000'],
            'nama_donatur' => ['required', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:100'],
            'telepon' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string', 'max:500'],
            'is_anonim' => ['nullable', 'boolean'],
            'catatan' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'jumlah.required' => 'Masukkan jumlah donasi.',
            'jumlah.min' => 'Minimal donasi Rp 1.000.',
            'nama_donatur.required' => 'Nama wajib diisi.',
        ];
    }
}
