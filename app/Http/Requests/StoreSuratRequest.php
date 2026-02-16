<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreSuratRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('surat.create');
    }

    public function rules(): array
    {
        return [
            'jenis_surat_id' => 'required|exists:jenis_surat,id',
            'penduduk_id' => 'required|exists:penduduk,id',
            'keperluan' => 'required|string|max:1000',
            'keterangan' => 'nullable|string|max:1000',
            'data_surat' => 'nullable|array',
        ];
    }

    public function messages(): array
    {
        return [
            'jenis_surat_id.required' => 'Jenis surat wajib dipilih.',
            'penduduk_id.required' => 'Penduduk wajib dipilih.',
            'keperluan.required' => 'Tujuan/Keperluan surat wajib diisi.',
        ];
    }
}
