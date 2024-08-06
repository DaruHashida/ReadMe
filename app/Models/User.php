<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'name',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Hash the user's password before saving to the database.
     *
     * @param  string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Get the posts for the user.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the comments for the user.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     *  Получение лайков пользователя.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Получение всех подписчиков пользователя.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function followers()
    {
        return $this->belongsToMany(
            User::class,
            'subscribes',
            'subscribe_id',
            'author_id'
        )->get();
    }

    /**
     * Получение всех пользователей, на которых подписан данный пользователь.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function subscriptions()
    {
        return $this->belongsToMany(
            User::class,
            'subscribes',
            'author_id',
            'subscribe_id'
        )->get();
    }

    /**
     * Получение всех сообщений пользователя
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Получение количества подписчиков пользователя.
     *
     * @return int
     */
    public function getFollowersCountAttribute()
    {
        return $this->followers()->count();
    }

    /**
     * Получение количества постов пользователя.
     *
     * @return int
     */
    public function getPostsCountAttribute()
    {
        return $this->posts()->count();
    }

    /**
     * Проверка, является ли данный пользователь подписчиком другого пользователя
     *
     * @param  User $user
     * @return mixed
     */
    public function isSubscribedBy(User $user)
    {
        return $this->followers()->where('id', $user->id)->count() > 0;
    }

    /**
     * Проверка, лайкнул ли данный пользователь данный пост
     *
     * @param  Post $post
     * @return bool
     */
    public function hasLiked( Post $post)
    {
        // Проверяем, есть ли у пользователя лайк на переданный пост
        return $this->likes()->where('post_id', $post->id)->exists();
    }

    public function userRelativeTime()
    {
        $registrationDate = $this->created_at;
        $now = now();
        $diff = $registrationDate->diffInSeconds($now);
        if ($diff < 3600) {
            $timeLabel = round($diff / 60, 0.5) . ' минут(ы) на сайте';
        } elseif ($diff < 86400) {
            $timeLabel = round($diff / 3600, 0.5) . ' часов(а) на сайте';
        } elseif ($diff < 31536000) {
            $timeLabel = round($diff / 86400, 0.5) . ' дней(я) на сайте';
        } else {
            $timeLabel = round($diff / 31536000, 0.5) . ' лет на сайте';
        }

        return $timeLabel;
    }

    /**
     * Выводит диалог
     */
    public function getDialog()
    {
        return Message::where(
            ['recipient_id'=> auth()->id(),
            'author_id'=>$this->id]
        )
            ->orWhere(
                ['recipient_id'=> $this->id,
                'author_id'=> auth()->id()]
            )->get();
    }

}
