<?php

namespace Database\Factories;

use App\Models\ContentType;
use App\Models\Hashtag;
use App\Models\Type;
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
        $contentTypes = Type::pluck('id')->toArray();
        $users = User::pluck('id')->toArray();
        $hashtags = Hashtag::pluck('id')->toArray();

        $post = [
            'title' => fake()->sentence(),
            'content' => fake()->paragraphs(2, true),
            'quote_author' => fake()->name(),
            'img' => fake()->imageUrl(),
            'video' => fake()->url(),
            'link' => fake()->url(),
            'repost' => fake()->boolean(),
            'user_id' => fake()->randomElement($users),
            'content_type_id' => fake()->randomElement($contentTypes),
            'original_author_id' => fake()->optional()->randomElement($users),
            'original_post_id' => fake()->optional()->numberBetween(1, 50),
        ];

        $post['hashtag_post'] = fake()->randomElements($hashtags, fake()->numberBetween(1, 3));

        return $post;
    }

    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            $post->hashtags()->attach($post->hashtag_post);
        });
    }
}
