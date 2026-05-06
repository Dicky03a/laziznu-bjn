<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class QurbanRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hewan_id' => ['required', 'exists:qurban_hewans,id'],
            'nama_peserta' => ['required', 'string', 'max:255'],
            'atas_nama' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'telepon' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string'],
            'catatan' => ['nullable', 'string'],
            'bukti_transfer' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
