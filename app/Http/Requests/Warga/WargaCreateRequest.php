<?php

namespace App\Http\Requests\Warga;

use Illuminate\Foundation\Http\FormRequest;

class WargaCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create residents');
    }

    public function rules(): array
    {
        return [
            'nik' => ['required', 'string', 'size:16', 'unique:penduduk,nik'],
            'no_kk' => ['nullable', 'string', 'size:16'],
            'nama' => ['required', 'string', 'max:255'],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'agama' => ['nullable', 'string', 'max:50'],
            'status_perkawinan' => ['nullable', 'string', 'max:50'],
            'pekerjaan' => ['nullable', 'string', 'max:100'],
            'pendidikan_terakhir' => ['nullable', 'string', 'max:100'],
            'kewarganegaraan' => ['nullable', 'string', 'max:5'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'keluarga_id' => ['nullable', 'exists:keluarga,id'],
            'status' => ['required', 'in:aktif,meninggal,pindah,hilang'],
        ];
    }
}
