<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQurbanRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_peserta' => ['required', 'string', 'max:100'],
            'atas_nama'    => ['nullable', 'string', 'max:100'],
            'email'        => ['nullable', 'email', 'max:100'],
            'telepon'      => ['nullable', 'string', 'max:20'],
            'alamat'       => ['nullable', 'string', 'max:500'],
            'catatan'      => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_peserta.required' => 'Nama peserta wajib diisi.',
            'email.email'           => 'Format email tidak valid.',
        ];
    }
}
