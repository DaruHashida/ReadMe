<?php

namespace App\Http\Controllers;

use App\Models\Hashtag;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Находим посты по тегу
     *
     * @param  string $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function searchTag(string $tag)
    {
        $tag = Hashtag::where('name', $tag)->firstOrFail();
        $posts = $tag->posts;
        return view(
            'feed', [
            'posts' => $posts
            ]
        );
    }

    /**
     * Находим посты по запросу в строке запроса
     *
     * @param  \Illuminate\Support\Facades\Request $query
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function searchQuery( Request $request)
    {
        // 1. Проверить, что в URL содержимое поискового запроса
        $query = $request->input('q');

        // 2. Получить текст из этого параметра и убрать пробелы функцией trim
        $query = trim($query);

        // 3. Проверить, что получившаяся строка не пустая
        if (empty($query)) {
            return redirect()->back();
        }

        // 4. Выполнить полнотекстовый поиск (операторы «MATCH... AGAINST») в таблице постов по полям «заголовок» и «содержимое»
        $posts = Post::whereRaw("MATCH(title, content) AGAINST(?)", [$query])
            ->paginate(10);

        // 5. Показать результаты поиска на соответствующей странице
        return view(
            'feed', [
            'posts' => $posts
            ]
        );
    }


}
