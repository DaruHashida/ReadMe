<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'author_id',
        'recipient_id',
    ];

    /**
     * Выводит автора сообщения
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Выводит адресата сообщения
     */
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    /**
     * Выводим строку относительного времени
     *
     * @return string
     */
    public function messageRelativeTime()
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
