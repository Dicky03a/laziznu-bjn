<?php

namespace App\Http\Requests\Qurban;

use Illuminate\Foundation\Http\FormRequest;

class StoreQurbanPeriodRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama'                 => ['required', 'string', 'max:200'],
            'tahun'                => ['required', 'integer', 'min:2020', 'max:2100'],
            'deskripsi'            => ['nullable', 'string'],
            'tanggal_buka'         => ['nullable', 'date'],
            'tanggal_tutup'        => ['nullable', 'date', 'after_or_equal:tanggal_buka'],
            'tanggal_pelaksanaan'  => ['nullable', 'date'],
            'is_active'            => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required'    => 'Nama periode wajib diisi.',
            'tahun.required'   => 'Tahun wajib diisi.',
            'tanggal_tutup.after_or_equal' => 'Tanggal tutup harus setelah tanggal buka.',
        ];
    }
}
