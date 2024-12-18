<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Edition;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
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
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'category_id' => Category::factory(),
            'edition_id' => Edition::factory(),
            'date' => $this->faker->dateTime,
        ];
    }
}
