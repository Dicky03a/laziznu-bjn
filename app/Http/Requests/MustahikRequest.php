<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MustahikRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $mustahik = $this->route('mustahik');

        return [
            'nama' => ['required', 'string', 'max:255'],
            'nik' => [
                'required',
                'string',
                'size:16',
                Rule::unique('mustahiks', 'nik')->ignore($mustahik),
            ],
            'jenis_kelamin' => ['required', Rule::in(['laki-laki', 'perempuan'])],
            'kecamatan_id' => ['required', 'integer', 'exists:kecamatans,id'],
            'desa_id' => ['required', 'integer', 'exists:desas,id'],
            'no_hp' => [
                'required',
                'string',
                'max:15',
                'regex:/^(\+62|0)[0-9]{9,12}$/',
            ],
            'kategori_asnaf' => [
                'required',
                Rule::in(['fakir', 'miskin', 'amil', 'muallaf', 'riqab', 'gharim', 'fisabilillah', 'ibnu_sabil']),
            ],
            'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi',
            'nama.string' => 'Nama harus berupa teks',
            'nama.max' => 'Nama maksimal 255 karakter',

            'nik.required' => 'NIK wajib diisi',
            'nik.size' => 'NIK harus 16 digit',
            'nik.unique' => 'NIK sudah terdaftar',

            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid',

            'kecamatan_id.required' => 'Kecamatan wajib dipilih',
            'kecamatan_id.exists' => 'Kecamatan tidak ditemukan',

            'desa_id.required' => 'Desa wajib dipilih',
            'desa_id.exists' => 'Desa tidak ditemukan',

            'no_hp.required' => 'Nomor HP wajib diisi',
            'no_hp.regex' => 'Format nomor HP tidak valid (081234567890 atau +6281234567890)',
            'no_hp.max' => 'Nomor HP terlalu panjang',

            'kategori_asnaf.required' => 'Kategori asnaf wajib dipilih',
            'kategori_asnaf.in' => 'Kategori asnaf tidak valid',

            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status tidak valid',
        ];
    }

    public function attributes(): array
    {
        return [
            'nama' => 'nama mustahik',
            'nik' => 'nomor identitas',
            'jenis_kelamin' => 'jenis kelamin',
            'kecamatan_id' => 'kecamatan',
            'desa_id' => 'desa',
            'no_hp' => 'nomor telepon',
            'kategori_asnaf' => 'kategori asnaf',
            'status' => 'status',
        ];
    }
}
