<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // ganti dengan policy nanti kalau perlu
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tahun_berdiri' => 'nullable|string|max:10',
            'penerima_manfaat' => 'nullable|integer|min:0',
            'program_tersalurkan' => 'nullable|integer|min:0',
            'visi' => 'nullable|string',

            // Validation for missions
            'missions' => 'nullable|array',
            'missions.*.text' => 'required|string|max:500',
            'missions.*.urutan' => 'nullable|integer|min:0',

            // Validation for pillars
            'pillars' => 'nullable|array',
            'pillars.*.title' => 'required|string|max:255',
            'pillars.*.deskripsi' => 'nullable|string',
            'pillars.*.urutan' => 'nullable|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul profil harus diisi',
            'missions.*.text.required' => 'Teks misi harus diisi',
            'pillars.*.title.required' => 'Judul pilar harus diisi',
        ];
    }
}
