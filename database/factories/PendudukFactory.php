<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penduduk>
 */
class PendudukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nik' => fake()->unique()->numerify('###############'),
            'nama' => fake()->name(),
            'tempat_lahir' => fake()->city(),
            'tanggal_lahir' => fake()->date(),
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'agama' => fake()->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'status_perkawinan' => fake()->randomElement(['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati']),
            'pekerjaan' => fake()->jobTitle(),
            'pendidikan_terakhir' => fake()->randomElement(['SD', 'SMP', 'SMA', 'S1', 'S2', 'S3']),
            'kewarganegaraan' => 'WNI',
            'alamat' => fake()->address(),
            'rt' => fake()->numerify('0#'),
            'rw' => fake()->numerify('0#'),
            'dusun' => fake()->randomElement(['Dusun A', 'Dusun B', 'Dusun C']),
            'golongan_darah' => fake()->randomElement(['A', 'B', 'AB', 'O']),
            'no_hp' => fake()->phoneNumber(),
            'foto' => null,
            'status_hubungan' => fake()->randomElement(['Kepala Keluarga', 'Istri', 'Anak', 'Famili Lain']),
            'status' => 'aktif',
            'catatan' => fake()->sentence(),
            'created_by' => null,
            'updated_by' => null,
        ];
    }
}
