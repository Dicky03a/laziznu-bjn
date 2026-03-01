<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLaporanMwc extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            'file_laporan' => 'nullable|file|mimes:pdf|max:10240', // max 10MB, optional saat update
        ];
    }

    /**
     * Get the validation error messages.
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama laporan harus diisi.',
            'nama.string' => 'Nama laporan harus berupa teks.',
            'nama.max' => 'Nama laporan maksimal 255 karakter.',
            'file_laporan.file' => 'File laporan harus berupa file.',
            'file_laporan.mimes' => 'File laporan harus berformat PDF.',
            'file_laporan.max' => 'Ukuran file maksimal 10MB.',
        ];
    }
}
