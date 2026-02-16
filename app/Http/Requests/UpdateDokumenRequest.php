<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDokumenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_dokumen' => [
                'required',
                'string',
                'max:255',
            ],
            'deskripsi' => [
                'nullable',
                'string',
            ],
            'file' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt',
                'max:10240', // 10MB
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_dokumen.required' => 'Nama dokumen wajib diisi',
            'file.mimes' => 'Format file harus pdf, doc, docx, xls, xlsx, ppt, pptx atau txt',
            'file.max' => 'Ukuran file maksimal 10MB',
        ];
    }
}
