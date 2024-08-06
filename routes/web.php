<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Главная страница
Route::get('/', function () {
    if (Auth::check()) {
        // Если пользователь авторизован, отправляем его в метод index() контроллера ленты
        return app(FeedController::class)->index();
    } else {
        // Если пользователь не авторизован, показываем представление home
        return view('home');
    }
});

Route::get('/login',function () {
    return redirect('/');
});

//Регистрация и логин пользователя
Route::get('/register', function () {
    if(Auth::check()) {
        // Если пользователь авторизован, отправляем его на главную
        return redirect('/');
    } else {
        // Если пользователь не авторизован, показываем форму регистрации
        return view('register');
    }
    });
Route::controller(AuthController::class)->group( function()
{
    Route::post('/register', 'createUser')->name('register');
    Route::post('/login','loginUser')->name('login');
    Route::get('/logout','logoutUser')->middleware('auth:sanctum')->name('logout');
}
);

// Публикация и репост записей в своём блоге,
Route::get('/posts/create/{any?}', function () {
    return view('post_create');
})->where('any', '.*')->middleware('auth:sanctum')->name('posts.create');

Route::controller(PostController::class)->middleware('auth:sanctum')->group(function () {
    //Роуты создания различных типов постов
    Route::post('/posts/create/photo', 'storePhoto')->name('posts.storePhoto');
    Route::post('/posts/create/text', 'storeText')->name('posts.storeText');
    Route::post('/posts/create/video', 'storeVideo')->name('posts.storeVideo');
    Route::post('/posts/create/quote', 'storeQuote')->name('posts.storeQuote');
    Route::post('/posts/create/link', 'storeLink')->name('posts.storeLink');
    //Репост
    Route::get('/posts/{post}/repost', 'repost')->name('posts.repost');
    //Роут-показ одного поста
    Route::get('posts/{post}','postView')->name('posts.show');
    // Просмотр популярных постов
    Route::get('/popular', 'popular')->name('posts.popular');
});

Route::controller(SearchController::class)->middleware('auth:sanctum')->group(function ()
{
    Route::get('/search/{tag}', 'searchTag')->name('search.tag');
    Route::get('/search', 'searchQuery')->name('search.query');
});

// Комментирование чужих записей и просмотр комментариев
Route::controller(CommentController::class)->middleware('auth:sanctum')->group(function () {
    Route::post('/posts/{post}/comment', 'storeComment')->name('comments.store');
});

//Просмотр профиля пользователя
Route::controller(UserController::class)->middleware('auth:sanctum')->group( function()
{
    Route::get('/users/{user}', 'show')->name('profile');
}
);

//Добавление и отмена лайков
    Route::controller(LikeController::class)->middleware('auth:sanctum')->group( function()
    {
        Route::get('/posts/{id}/like', 'storeLike')->name('post.like');
        Route::get('/posts/{id}/unlike', 'destroyLike')->name('post.unlike');
    }
);

// Подписка на пользователей, просмотр своей ленты по подписке
Route::controller(SubscribeController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/feed', [SubscribeController::class, 'show'])->name('subscribe.show');
    Route::get('/users/{id}/subscribe', 'subscribe')->name('subscribe.do');
    Route::get('/users/{user}/unsubscribe', 'unsubscribe')->name('subscribe.undo');
});

// Переписка с другими пользователями
Route::controller(MessageController::class)->middleware('auth')->group(function () {
    Route::view('/messages','messages');
    Route::get('/messages/{user}', 'show')->name('messages.show');
    Route::post('/messages/{user}', 'store')->name('messages.store');
});

//Фильтры по популярности и типам записей
Route::controller(FeedController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/popular', 'popular')->name('popular.index');
    Route::get('/feed/{selector}', 'postsOfType')->name('selector.index');
});
