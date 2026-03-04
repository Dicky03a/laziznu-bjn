<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreZakatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'jenis' => ['required', 'in:mal,fitrah'],
            'nama_donatur' => ['required', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:100'],
            'telepon' => ['nullable', 'string', 'max:20'],
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'desa_id' => 'required|exists:desas,id',
            'is_anonim' => ['nullable', 'boolean'],
            'catatan' => ['nullable', 'string', 'max:500'],
        ];

        if ($this->jenis === 'mal') {
            $rules['nilai_harta'] = ['required', 'integer', 'min:1'];
        } elseif ($this->jenis === 'fitrah') {
            $rules['jumlah_jiwa'] = ['required', 'integer', 'min:1', 'max:100'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'jenis.required' => 'Pilih jenis zakat terlebih dahulu.',
            'jenis.in' => 'Jenis zakat tidak valid.',
            'nama_donatur.required' => 'Nama wajib diisi.',
            'nilai_harta.required' => 'Masukkan total nilai harta.',
            'kecamatan_id.required' => 'Kecamatan harus dipilih',
            'kecamatan_id.exists' => 'Kecamatan tidak valid',
            'desa_id.required' => 'Desa/Kelurahan harus dipilih',
            'desa_id.exists' => 'Desa/Kelurahan tidak valid',
            'nilai_harta.min' => 'Nilai harta harus lebih dari 0.',
            'jumlah_jiwa.required' => 'Masukkan jumlah jiwa yang akan dizakati.',
            'jumlah_jiwa.min' => 'Minimal 1 jiwa.',
        ];
    }
}
