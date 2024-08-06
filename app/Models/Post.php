<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'quote_author',
        'img',
        'video',
        'link',
        'user_id',
        'content_type_id',
    ];

    /**
     * Получение хозяина поста.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Получение автора оригинала поста
     */
    public function originalAuthor()
    {
        return $this->belongsTo(User::class, 'original_author_id');
    }
    /**
     * Получение типа контента, к которому относится пост.
     */
    public function contentType()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Получение хэштегов поста.
     */
    public function hashtags()
    {
        return $this->belongsToMany(Hashtag::class);
    }
    /**
     * Получение лайков поста.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    /**
     * Получение количества лайков для поста.
     *
     * @return int
     */
    public function likesCount()
    {
        return $this->hasMany(Like::class)->count();
    }
    /**
     * Получение комментов поста.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Получение количества комментов поста.
     *
     * @return int
     */
    public function commentsCount()
    {
        return $this->hasMany(Comment::class)->count();
    }

    /**
     * Получение количества репостов записи
     *
     * @return mixed
     */
    public function repostsCount()
    {
        return $this->where('original_author_id', $this->user_id)->where('original_post_id', $this->id)
            ->count();
    }

    /**
     * Выводит строку относительного времени
     *
     * @return string
     */
    public function postRelativeTime()
    {
        $publicationDate = $this->created_at;
        $now = now();
        $diff = $publicationDate->diffInSeconds($now);
        if ($diff < 3600) {
            $timeLabel = round($diff / 60, 0.5) . ' минут(ы) назад';
        } elseif ($diff < 86400) {
            $timeLabel = round($diff / 3600, 0.5) . ' часов(а) назад';
        } elseif ($diff < 31536000) {
            $timeLabel = round($diff / 86400, 0.5) . ' дней(я) назад';
        } else {
            $timeLabel = round($diff / 31536000, 0.5) . ' лет назад';
        }
        return($timeLabel);
    }

}
