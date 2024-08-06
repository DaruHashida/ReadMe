<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
    ];
    /**
     * Пользователь, который поставил лайк.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Пост, которому был поставлен лайк.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * @return string
     */
    public function likeRelativeTime()
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
