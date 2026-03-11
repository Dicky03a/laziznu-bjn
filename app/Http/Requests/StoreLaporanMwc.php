<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLaporanMwc extends FormRequest
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
            'nama' => 'required|string|max:255',
            'file_laporan' => 'required|file|mimes:pdf|max:10240', // max 10MB
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama harus diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            'file_laporan.required' => 'File laporan harus diunggah.',
            'file_laporan.file' => 'File laporan harus berupa file.',
            'file_laporan.mimes' => 'File laporan harus berformat PDF.',
            'file_laporan.max' => 'Ukuran file maksimal 10MB.',
        ];
    }
}
