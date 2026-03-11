<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDokumenRequest extends FormRequest
{
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
            'nama_dokumen' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_dokumen.required' => 'Nama dokumen wajib diisi',
            'file.required' => 'File dokumen wajib diupload',
            'file.mimes' => 'Format file harus pdf, doc, docx, xls, xlsx, ppt atau pptx',
            'file.max' => 'Ukuran file maksimal 10MB',
        ];
    }
}
