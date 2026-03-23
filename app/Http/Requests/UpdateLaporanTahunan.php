<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLaporanTahunan extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => [
                'required',
                'string',
                'max:255',
                Rule::unique('laporan_tahunans', 'nama')->ignore($this->laporanTahunan->id),
            ],
            'link_from' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => __('Nama laporan harus diisi'),
            'link_from.required' => __('Link harus diisi'),
        ];
    }
}
