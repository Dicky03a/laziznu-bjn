<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'in:zakat,infaq,donasi,fidyah'],
            'program_id' => ['nullable', 'exists:programs,id'],
            'nama_donatur' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'telepon' => ['nullable', 'string', 'max:20'],
            'kecamatan_id' => ['nullable', 'exists:kecamatans,id'],
            'desa_id' => ['nullable', 'exists:desas,id'],
            'is_anonim' => ['nullable', 'boolean'],
            'jumlah' => ['required', 'numeric', 'min:1000'],
            'catatan' => ['nullable', 'string'],
            'bukti_transfer' => ['nullable', 'image', 'max:2048'],

            // Metadata for zakat
            'zakat_jenis' => [
                'nullable',
                'in:mal,fitrah',
                function ($attribute, $value, $fail) {
                    if ($this->type === 'zakat' && ! $value && ! $this->program_id) {
                        $fail('Jenis zakat atau Program harus dipilih untuk transaksi Zakat.');
                    }
                },
            ],
            'nilai_harta' => ['nullable', 'required_if:zakat_jenis,mal', 'numeric', 'min:0'],
            'jumlah_jiwa' => ['nullable', 'required_if:zakat_jenis,fitrah', 'integer', 'min:1'],

            // Metadata for fidyah
            'jumlah_hari' => ['nullable', 'required_if:type,fidyah', 'integer', 'min:1'],
        ];
    }
}
