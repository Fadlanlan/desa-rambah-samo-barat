<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Berita>
 */
class BeritaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $judul = fake()->sentence();
        return [
            'judul' => $judul,
            'slug' => Str::slug($judul),
            'ringkasan' => fake()->paragraph(1),
            'konten' => fake()->paragraph(5),
            'gambar' => null,
            'is_published' => true,
            'is_featured' => fake()->boolean(20),
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'views_count' => fake()->numberBetween(0, 1000),
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
        ];
    }
}
