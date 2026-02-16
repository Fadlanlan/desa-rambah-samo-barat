<?php

namespace Database\Seeders;

use App\Models\Penduduk;
use App\Models\Berita;
use App\Models\JenisSurat;
use App\Models\Pengaduan;
use App\Models\Antrian;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoSeeder extends Seeder
{
    /**
     * Seed the application's database with demo data.
     */
    public function run(): void
    {
        // 1. Create Mock Residents (50 people)
        $penduduks = Penduduk::factory()->count(50)->create();

        // 2. Create Mock News (10 items)
        Berita::factory()->count(10)->create([
            'user_id' => User::first()->id
        ]);

        // 3. Create Basic Jenis Surat (if not exists)
        $layanan = [
            ['nama' => 'Surat Keterangan Tidak Mampu', 'kode' => 'SKTM', 'is_active' => true],
            ['nama' => 'Surat Keterangan Domisili', 'kode' => 'SKD', 'is_active' => true],
            ['nama' => 'Surat Keterangan Usaha', 'kode' => 'SKU', 'is_active' => true],
            ['nama' => 'Surat Pengantar Nikah', 'kode' => 'SPN', 'is_active' => true],
        ];

        foreach ($layanan as $item) {
            JenisSurat::updateOrCreate(['kode' => $item['kode']], $item);
        }

        // 4. Create Mock Complaints (15 items)
        foreach (range(1, 15) as $i) {
            $p = $penduduks->random();
            Pengaduan::create([
                'nomor_tiket' => 'ADU-' . date('Ymd') . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'penduduk_id' => $p->id,
                'nama_pelapor' => $p->nama,
                'kontak_pelapor' => $p->no_hp,
                'judul' => 'Contoh Keluhan ' . $i,
                'isi' => 'Ini adalah simulasi isi aduan kependudukan yang membutuhkan perhatian admin.',
                'kategori' => ['layanan', 'infrastruktur', 'keamanan', 'Lainnya'][rand(0, 3)],
                'prioritas' => ['rendah', 'sedang', 'tinggi'][rand(0, 2)],
                'status' => ['baru', 'diproses', 'selesai'][rand(0, 2)],
            ]);
        }

        // 5. Create Mock Queues for Today (10 items)
        foreach (range(1, 10) as $i) {
            $p = $penduduks->random();
            Antrian::create([
                'uuid' => (string)Str::uuid(),
                'nomor_antrian' => 'A-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama_pengunjung' => $p->nama,
                'nik_pengunjung' => $p->nik,
                'penduduk_id' => $p->id,
                'keperluan' => 'Pengurusan ' . JenisSurat::all()->random()->nama,
                'tanggal_kunjungan' => date('Y-m-d'),
                'jam_kunjungan' => str_pad(rand(8, 11), 2, '0', STR_PAD_LEFT) . ':00',
                'status' => 'menunggu',
                'token_akses' => Str::random(40),
            ]);
        }
    }
}
