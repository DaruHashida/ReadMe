<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Функция показа профиля юзера
     *
     * @param  User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(User $user)
    {
        $timeLabel = $user->userRelativeTime();
        $posts = Post::where('user_id', $user->id)->with(['user','contentType'])->orderBy('created_at', 'desc')->get();
        return view(
            'profile', [
            'user' => $user,
            'timeLabel' => $timeLabel,
            'posts'=> $posts,
            ]
        );
    }
}
