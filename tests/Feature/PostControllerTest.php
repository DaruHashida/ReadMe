<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Requests\TextRequest;
use App\Models\Hashtag;
use App\Models\Post;
use App\Models\Type;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_can_store_a_new_post()
    {
        $user = User::factory()->create();
        Auth::loginUsingId($user->id, true);
        Sanctum::actingAs($user);
        $this->actingAs($user);


        $contentType = Type::where('title','text')->firstOrFail();

        $data = [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraphs(3, true),
            'hashtags' => $this->faker->words(3, false),
        ];

        $response = $this->post(route('posts.storeText'), $data);

        $response->assertRedirect(route('posts.show', 1));

        $this->assertDatabaseHas('posts', [
            'user_id' => $user->id,
            'content_type_id' => $contentType->id,
            'title' => $data['title'],
            'content' => $data['content'],
        ]);

        $post = Post::first();

        foreach ($data['hashtags'] as $hashtag) {
            $this->assertDatabaseHas('hashtags', [
                'name' => $hashtag,
            ]);

            $this->assertDatabaseHas('hashtag_post', [
                'hashtag_id' => Hashtag::where('name', $hashtag)->first()->id,
                'post_id' => $post->id,
            ]);
        }
    }
}
