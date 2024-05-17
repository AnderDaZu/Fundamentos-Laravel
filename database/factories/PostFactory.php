<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence();
        $title_slug = Str::slug($title);

        return [
            'main_title' => $title,
            'slug' => $title_slug,
            'body' => fake()->paragraphs(5, true),
            'category_id' => fake()->numberBetween(1, 10),
            'user_id' => fake()->numberBetween(1, 1000)
        ];
    }
}
