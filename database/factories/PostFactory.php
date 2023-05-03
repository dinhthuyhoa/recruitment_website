<?php

namespace Database\Factories;

use App\Enums\PostCategory;
use App\Models\PostMeta;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Buihuycuong\Vnfaker\VNFaker;

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
        $paragraphs = VNFaker::paragraphs(rand(6, 15));
        // $post = "";
        // foreach ($paragraphs as $para) {
        //     $post .= "<p>{$para}</p>";
        // }

        return [
            'user_id' => User::all()->random()->id,
            'post_title' => $this->faker->realText(40),
            'post_content' => $paragraphs,
            'post_description' => VNFaker::sentences(rand(2, 8)),
            'post_image' => 'post/' . $this->faker->image('public/storage/post', 400, 400, false),
            'post_view' => 0,
            'post_status' => $this->faker->randomElement(['draft', 'pendding', 'publish']),
            'post_type' => $this->faker->randomElement(PostCategory::getValues()),
        ];
    }
}
