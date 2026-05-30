<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DistributionProgramRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'source_program_id' => [
                'required',
                'exists:programs,id',
                Rule::exists('programs', 'id')->where(function ($query) {
                    $query->whereIn('type', ['infaq', 'donasi', 'zakat']);
                }),
            ],
            'nama' => ['required', 'string', 'max:200'],
            'deskripsi' => ['required', 'string'],
            'konten' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'target_dana' => ['required', 'integer', 'min:1000'],
            'is_active' => ['boolean'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
        ];
    }
}
