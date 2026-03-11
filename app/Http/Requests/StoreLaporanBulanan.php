<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLaporanBulanan extends FormRequest
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
            'nama_laporan' => 'required|string|max:255',
            'file_laporan' => 'required|file|mimes:pdf|max:10240', // max 10MB
        ];
    }

    /**
     * Get the validation error messages.
     */
    public function messages(): array
    {
        return [
            'nama_laporan.required' => 'Nama laporan harus diisi.',
            'nama_laporan.string' => 'Nama laporan harus berupa teks.',
            'nama_laporan.max' => 'Nama laporan maksimal 255 karakter.',
            'file_laporan.required' => 'File laporan harus diunggah.',
            'file_laporan.file' => 'File laporan harus berupa file.',
            'file_laporan.mimes' => 'File laporan harus berformat PDF.',
            'file_laporan.max' => 'Ukuran file maksimal 10MB.',
        ];
    }
}
