<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLaporanTahunan extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255|unique:laporan_tahunans,nama',
            'link_from' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => __('Nama laporan harus diisi'),
            'nama.unique' => __('Nama laporan sudah ada'),
            'link_from.required' => __('Link harus diisi'),
        ];
    }
}
