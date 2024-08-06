<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Создание лайка для поста.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeLike( int $postId)
    {
        // Проверить, что пост существует
        if(!Like::where('user_id', Auth::id())->where('post_id', $postId)->exists()
        ) {
            $post = Post::findOrFail($postId);

            $like = Auth::user()->likes()->create(
                [
                'post_id' => $post->id
                ]
            );
        }
        return redirect()->back();
    }
    /**
     * Отмена лайка
     *
     * @param  int $postId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyLike(int $postId)
    {
        // Удаляем лайк
        $like = Like::where('user_id', Auth::id())
            ->where('post_id', $postId)
            ->first();

        if ($like) {
            $like->delete();
        }

        // Возвращаем пользователя на предыдущую страницу
        return redirect()->back();
    }
}
