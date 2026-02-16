<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRekeningRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rekening = $this->route('rekening');

        return [
            'nama' => [
                'required',
                'string',
                'max:255',
                Rule::unique('rekenings', 'nama')->ignore($rekening),
            ],
            'bank_atas_nama' => [
                'required',
                'string',
                'max:255',
            ],
            'nomor_rekening' => [
                'required',
                'string',
                'max:30',
                Rule::unique('rekenings', 'nomor_rekening')->ignore($rekening),
            ],
            'icon' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,webp,svg',
                'max:10048',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama harus diisi',
            'nama.unique' => 'Nama sudah digunakan',

            'bank_atas_nama.required' => 'Nama pemilik rekening harus diisi',

            'nomor_rekening.required' => 'Nomor rekening harus diisi',
            'nomor_rekening.unique' => 'Nomor rekening sudah digunakan',

            'icon.image' => 'File harus berupa gambar',
            'icon.mimes' => 'Format gambar harus jpeg, png, jpg, webp atau svg',
            'icon.max' => 'Ukuran gambar maksimal 10MB',
        ];
    }
}
