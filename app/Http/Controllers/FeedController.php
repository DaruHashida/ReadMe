<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    public function index()
    {
        $posts = Post::whereNotIn('user_id', [Auth::id()])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view(
            'feed', [
            'posts' => $posts
            ]
        );
    }

    public function popular()
    {
        $posts = Post::withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->paginate(20);

        return view(
            'feed', [
            'posts' => $posts
            ]
        );
    }

    public function postsOfType(string $selector)
    {
        $type = Type::where('title', $selector)->first();
        $posts = Post::where('content_type_id', $type->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view(
            'feed', [
            'posts' => $posts
            ]
        );
    }
}
