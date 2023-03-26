<?php

namespace Database\Factories;

use App\Enums\PostCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'post_title' => $this->faker->name(),
            'post_content' => $this->faker->text(),
            'post_view' => $this->faker->randomNumber(5, false),
            'post_status' => $this->faker->randomElement(['draft', 'pendding', 'publish']),
            'post_type' => $this->faker->randomElement(PostCategory::getValues()),
        ];
    }
}
