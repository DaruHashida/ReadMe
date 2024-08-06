<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscribe extends Model
{
    use HasFactory;
    protected $fillable =
        [ 'author_id' ,
          'subscribe_id'
        ];
    /**
     * Тот, кто подписался
     *
     * @return BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Тот, на кого подписались
     *
     * @return BelongsTo
     */
    public function subscribe()
    {
        return $this->belongsTo(User::class, 'subscribe_id');
    }
}
