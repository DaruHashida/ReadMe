<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Http\Requests\PhotoRequest;
use App\Http\Requests\QuoteRequest;
use App\Http\Requests\TextRequest;
use App\Http\Requests\VideoRequest;
use App\Models\Hashtag;
use App\Models\Post;
use App\Models\Type;
use App\services\PostThumbnailService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct(private PostThumbnailService $postThumbnailService)
    {
    }

    /**
     * Функция публикации поста типа "Фото"
     *
     * @param  PhotoRequest $request
     * @return RedirectResponse
     */
    public function storePhoto(PhotoRequest $request)
    {
        $validatedData = $request->safe();
        $path = public_path('posts/');
        //Сохранение картинки
        if ($request->file('image')) {
            $content = $request->file('image');
            $name = uniqid() . '.' . $content->getClientOriginalExtension();
            $content->move($path, $name);
            $imagePath='posts/'.$name;
        }
        else
        {
            $image_url = $request->input('image_url');
            $content = file_get_contents($image_url);
            $ext = pathinfo($image_url, PATHINFO_EXTENSION);
            $imagePath= $this->storeFile($content, $ext);
        }


        //Выбираем тип публикации
        $type = Type::where('title', 'photo')->firstOrFail();
        $validatedData = $validatedData->merge(
            ['img' => $imagePath,
                                                'user_id'=>Auth::id(),
            'content_type_id'=>$type->id]
        );


        //Создание поста
        $post = Post::create($validatedData->only(['title', 'img', 'user_id','content_type_id']));

        // Отправка уведомлений подписчикам
        $this->sendMessage($post);

        // Сохранение тегов
        $this->storeTags($validatedData, $post);

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Функция публикации поста типа "Текст"
     *
     * @param  TextRequest $request
     * @return RedirectResponse
     */
    public function storeText(TextRequest $request)
    {
        $validatedData = $request->safe();
        //Сохранение типа
        $type = Type::where('title', 'text')->firstOrFail();
        $validatedData = $validatedData->merge(
            [
            'user_id'=>Auth::id(),
            'content_type_id'=>$type->id]
        );

        //Создание поста
        $post = Post::create($validatedData->all());

        // Отправка уведомлений подписчикам
        $this->sendMessage($post);

        // Сохранение тегов
        $this->storeTags($validatedData, $post);

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Создание записи типа "Видео"
     *
     * @param  VideoRequest $request
     * @return RedirectResponse
     */
    public function storeVideo(VideoRequest $request)
    {
        $validatedData = $request->safe();
        //Сохранение типа
        $type = Type::where('title', 'video')->firstOrFail();
        $validatedData = $validatedData->merge(
            [
            'user_id'=>Auth::id(),
            'content_type_id'=>$type->id]
        );

        //Создание поста
        $post = Post::create($validatedData->all());

        // Отправка уведомлений подписчикам
        $this->sendMessage($post);

        // Сохранение тегов
        $this->storeTags($validatedData, $post);

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Создание записи типа "Видео"
     *
     * @param  VideoRequest $request
     * @return RedirectResponse
     */
    public function storeQuote(QuoteRequest $request)
    {
        $validatedData = $request->safe();
        //Сохранение типа
        $type = Type::where('title', 'quote')->firstOrFail();
        $validatedData = $validatedData->merge(
            [
            'user_id'=>Auth::id(),
            'content_type_id'=>$type->id]
        );

        //Создание поста
        $post = Post::create($validatedData->all());

        // Отправка уведомлений подписчикам
        $this->sendMessage($post);

        // Сохранение тегов
        $this->storeTags($validatedData, $post);
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Создание записи типа "Ссылка"
     *
     * @param  LinkRequest $request
     * @return JsonResponse
     */
    public function storeLink(LinkRequest $request)
    {
        $validatedData=$request->safe();
        $link = $request->input('link');

        // Сохраняем превью в папку public/posts/previews/
        $previewPath = $this->storeFile($this->postThumbnailService->getPostThumbnail($link), 'jpg');

        //Находим тип
        $type = Type::where('title', 'link')->firstOrFail();

        // Создаем новый пост
        $validatedData = $validatedData->merge(
            [
            'user_id'=>Auth::id(),
            'content_type_id' => $type->id,
            'img' => $previewPath,
            ]
        );

        $post = Post::create($validatedData->all());

        // Отправка уведомлений подписчикам
        $this->sendMessage($post);

        // Сохранение тегов
        $this->storeTags($validatedData, $post);

        // Переходим к странице поста
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Сохранение файла в папку public
     *
     * @param  $file
     * @param  $ext
     * @return string
     */
    protected function storeFile($file, $ext)
    {
        // Сохраняем в папку public/posts/
        $name = uniqid(). '.' . $ext;
        $path = 'posts/';
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $filePath = $path.$name;
        file_put_contents($path . $name, $file);
        return $filePath;
    }

    public function repost(int $originalPostId)
    {
        // Проверяем, существует ли пост с таким ID в базе данных
        $originalPost = Post::findOrFail($originalPostId);

        // Создаем новый пост на основе оригинального
        $newPost = $originalPost->replicate();
        $newPost->user_id = auth()->id(); // Меняем ID автора на текущего пользователя
        $newPost->created_at = now(); // Меняем дату/время публикации на текущую
        $newPost->repost = true; // Устанавливаем признак "Репост"
        $newPost->original_author_id = $originalPost->user_id; // Заполняем поле "Автор оригинальной записи"
        $newPost->original_post_id = $originalPost->id; // Заполняем поле "Оригинал записи"
        $newPost->save(); // Сохраняем новый пост

        // Выполняем переадресацию на страницу профиля текущего пользователя
        return redirect()->route('profile', auth()->user());
    }

    /**
     * Просмотр одного поста
     *
     * @param  Post $post
     * @return Factory|View
     */
    public function postView(Post $post)
    {
        return view('post_view', ['post' => $post]);
    }

    /**
     * Отправка увеомлений
     *
     * @param Post $post
     */
    private function sendMessage(Post $post)
    {
        if($post->user->followers_count > 0) {
                $post->user->followers()->each(
                    function ($follower) use ($post) {
                        $follower->notify(new NewPost($post));
                    }
                );
        }
    }
    /**
     * Сохранение тегов
     */
    public function storeTags($validatedData, Post $post)
    {
        $tags = explode(' ', $validatedData['hashtags']);
        $hashtags = array_map(
            function ($tag) use ($post) {
                return Hashtag::firstOrCreate(['name' => $tag])->posts()->attach($post->id);
            }, $tags
        );
        return($hashtags);
    }
}
