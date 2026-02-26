<?php

namespace App\Http\Requests\Qurban;

use Illuminate\Foundation\Http\FormRequest;

class StoreQurbanPaymentConfirmationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_pengirim'           => ['required', 'string', 'max:100'],
            'bank_pengirim'           => ['required', 'string', 'max:50'],
            'nomor_rekening_pengirim' => ['nullable', 'string', 'max:30'],
            'jumlah_transfer'         => ['required', 'integer', 'min:1'],
            'tanggal_transfer'        => ['required', 'date', 'before_or_equal:today'],
            'bukti_transfer'          => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'catatan'                 => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_pengirim.required'    => 'Nama pengirim wajib diisi.',
            'bank_pengirim.required'    => 'Nama bank wajib diisi.',
            'jumlah_transfer.required'  => 'Jumlah transfer wajib diisi.',
            'tanggal_transfer.required' => 'Tanggal transfer wajib diisi.',
            'tanggal_transfer.before_or_equal' => 'Tanggal tidak boleh lebih dari hari ini.',
            'bukti_transfer.image'      => 'File bukti harus berupa gambar.',
            'bukti_transfer.max'        => 'Ukuran file maksimal 2MB.',
        ];
    }
}
