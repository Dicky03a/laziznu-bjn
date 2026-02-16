<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'deskripsi' => $this->faker->paragraph(3),
            'tahun_berdiri' => $this->faker->year(),
            'penerima_manfaat' => $this->faker->numberBetween(100, 10000),
            'program_tersalurkan' => $this->faker->numberBetween(5, 50),
            'visi' => $this->faker->paragraph(2),
        ];
    }
}
