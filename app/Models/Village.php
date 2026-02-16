<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $fillable = [
        'nama_desa',
        'kode_desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',
        'alamat_kantor',
        'telepon',
        'email',
        'website',
        'visi',
        'misi',
        'sejarah',
        'struktur_organisasi',
        'logo',
        'latitude',
        'longitude',
        'nama_kepala_desa',
        'nip_kepala_desa'
    ];

    protected $casts = [
        'struktur_organisasi' => 'array',
    ];
}
