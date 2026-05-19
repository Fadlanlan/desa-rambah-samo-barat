<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembangunan extends Model
{
    protected $fillable = [
        'nama', 'tahun', 'kategori', 'lokasi', 'anggaran', 'realisasi', 
        'pj', 'status', 'progress', 'sumber_dana', 'lat_long', 'deskripsi', 
        'foto_sebelum', 'foto_sesudah'
    ];
}
