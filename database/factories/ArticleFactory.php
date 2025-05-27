<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = rand(0, 1);
        $title = fake()->sentence();
        return [
            'title' => $title,
            'content' => fake()->paragraph(),
            'slug' => Str::slug($title),
            'status' => $status ? 'published' : 'draft',
            'user_id' => 1,
            'published_at' => $status ? now() : null
        ];
    }
}
