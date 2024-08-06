<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'post_id',
        'user_id'
    ];

    /**
     * Get the user that created the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the post that the comment belongs to.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * @return string
     */
    public function commentRelativeTime()
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
