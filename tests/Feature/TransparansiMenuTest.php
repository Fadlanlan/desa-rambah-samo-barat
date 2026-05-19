<?php

use Database\Seeders\SettingSeeder;

test('new transparency pages are accessible and render successfully', function () {
    $this->seed(SettingSeeder::class);

    // 1. Assert Halaman Transparansi renders
    $response = $this->get(route('public.transparansi.index'));
    $response->assertStatus(200);
    $response->assertSee('Transparansi Informasi Keuangan Desa');
    $response->assertSee('TA 2026');

    // 2. Assert Halaman APBDes renders
    $response = $this->get(route('public.apbdes.index'));
    $response->assertStatus(200);
    $response->assertSee('Anggaran Pendapatan');
    $response->assertSee('Belanja Desa (APBDes)');

    // 3. Assert Halaman Realisasi renders
    $response = $this->get(route('public.realisasi.index'));
    $response->assertStatus(200);
    $response->assertSee('Realisasi Anggaran');
    $response->assertSee('Laporan Keuangan Berkala');

    // 4. Assert Halaman Laporan Pembangunan renders
    $response = $this->get(route('public.pembangunan.index'));
    $response->assertStatus(200);
    $response->assertSee('Log Pembangunan Fisik');
});
