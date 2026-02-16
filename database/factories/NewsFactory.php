<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(4);

        return [
            'title' => rtrim($title, '.'),
            'slug' => str()->slug($title),
            'category_id' => null,
            'featured_image' => null,
            'content' => $this->faker->paragraphs(5, true),
            'excerpt' => $this->faker->sentence(10),
            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
