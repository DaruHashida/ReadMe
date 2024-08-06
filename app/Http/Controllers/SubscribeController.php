<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use App\Models\User;
use App\Notifications\NewSubscriber;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    /**
     * Подписка на пользователя
     *
     * @param  int $subscribedToId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribe(int $subscribedToId)
    {

        $subscribedToUser = User::findOrFail($subscribedToId);

        // Проверка, что пользователь не пытается подписаться на самого себя
        if ($subscribedToUser->id === auth()->id()) {
            return redirect()->back()->withErrors(
                [
                'subscribe' => 'Вы не можете подписаться на самого себя.',
                ]
            );
        }

        // Проверка, что пользователь еще не подписан на этого пользователя
        if (Subscribe::where('author_id', auth()->id())->where('subscribe_id', $subscribedToId)->exists()
        ) {
            return redirect()->back()->withErrors(
                [
                'subscribe' => 'Вы уже подписаны на этого пользователя.',
                ]
            );
        }

        $subscribe = Subscribe::create(
            [
            'author_id' => auth()->id(),
            'subscribe_id' => $subscribedToId,
            ]
        );

        $subscribedToUser->notify(new NewSubscriber(auth()->user()));

        return redirect()->route('profile', $subscribedToUser->id);
    }

    /**
     * Отписка от пользователя
     *
     * @param  int $subscribedToId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unsubscribe(int $subscribedToId)
    {
        $subscribe = Subscribe::where(
            ['subscribe_id' => $subscribedToId,
            'author_id'=> auth()->id()]
        )
                                        ->first();

        // Если запись найдена, удаляем её
        if ($subscribe) {
            $subscribe->delete();
        }
        else
        {
            return redirect()->back()->withErrors(
                [
                'subscribe' => 'Вы не подписаны на этого пользователя!',
                ]
            );
        }

        // Выполняем переадресацию на профиль пользователя
        return redirect()->route('profile', $subscribedToId);
    }
}
