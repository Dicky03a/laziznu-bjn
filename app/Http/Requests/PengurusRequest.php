<?php

namespace App\Http\Requests;

use App\Models\Pengurus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PengurusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Sesuaikan dengan gate/policy Anda
    }

    public function rules(): array
    {
        return [
            'nama'                 => ['required', 'string', 'max:100'],
            'gelar_depan'          => ['nullable', 'string', 'max:50'],
            'gelar_belakang'       => ['nullable', 'string', 'max:100'],
            'jabatan'              => ['required', Rule::in(Pengurus::JABATAN_LIST)],
            'bidang'               => [
                Rule::requiredIf(fn() => $this->jabatan === 'Anggota'),
                'nullable',
                Rule::in(Pengurus::BIDANG_LIST),
            ],
            'urutan'               => ['required', 'integer', 'min:0', 'max:255'],
            'foto'                 => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'no_hp'                => ['nullable', 'string', 'max:20'],
            'email'                => ['nullable', 'email', 'max:100'],
            'masa_khidmat_mulai'   => ['required', 'integer', 'digits:4', 'min:2000'],
            'masa_khidmat_selesai' => ['required', 'integer', 'digits:4', 'gte:masa_khidmat_mulai'],
            'no_sk'                => ['nullable', 'string', 'max:100'],
            'is_active'            => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required'                  => 'Nama wajib diisi.',
            'jabatan.required'               => 'Jabatan wajib dipilih.',
            'jabatan.in'                     => 'Jabatan tidak valid.',
            'bidang.required_if'             => 'Bidang wajib diisi untuk jabatan Anggota.',
            'bidang.in'                      => 'Bidang tidak valid.',
            'foto.image'                     => 'File harus berupa gambar.',
            'foto.max'                       => 'Ukuran foto maksimal 2 MB.',
            'masa_khidmat_mulai.required'    => 'Tahun mulai masa khidmat wajib diisi.',
            'masa_khidmat_selesai.required'  => 'Tahun selesai masa khidmat wajib diisi.',
            'masa_khidmat_selesai.gte'       => 'Tahun selesai harus sama dengan atau setelah tahun mulai.',
            'email.email'                    => 'Format email tidak valid.',
            'urutan.required'                => 'Urutan wajib diisi.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nama'                 => 'Nama',
            'gelar_depan'          => 'Gelar Depan',
            'gelar_belakang'       => 'Gelar Belakang',
            'jabatan'              => 'Jabatan',
            'bidang'               => 'Bidang',
            'urutan'               => 'Urutan',
            'foto'                 => 'Foto',
            'no_hp'                => 'No. HP',
            'email'                => 'Email',
            'masa_khidmat_mulai'   => 'Tahun Mulai',
            'masa_khidmat_selesai' => 'Tahun Selesai',
            'no_sk'                => 'Nomor SK',
            'is_active'            => 'Status Aktif',
        ];
    }
}
