<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFidyahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'jumlah_hari' => ['required', 'integer', 'min:1', 'max:365'],
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
            'jumlah_hari.required' => 'Masukkan jumlah hari hutang puasa.',
            'jumlah_hari.min' => 'Minimal 1 hari.',
            'jumlah_hari.max' => 'Maksimal 365 hari.',
            'nama_donatur.required' => 'Nama wajib diisi.',
        ];
    }
}
