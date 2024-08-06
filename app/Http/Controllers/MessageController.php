<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Показываем окно сообщений с пользователем
     *
     * @param  User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(User $user)
    {
        $messages = $user->getDialog();
        return view(
            'messages_user', ['user'=>$user,
            'messages'=>$messages]
        );
    }
    /**
     * Сохраняем сообщение
     *
     * @param  \App\Http\Requests\MessageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request)
    {
        $params = $request->safe();

        $message = Message::create($params->merge(['author_id'=>auth()->id()])->all());

        return redirect()->back();
    }

}
