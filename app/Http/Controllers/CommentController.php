<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{

    public function storeComment(CommentRequest $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->safe();
            $validated['content'] = trim($validated['content']);
            $validated = $validated->merge(['user_id'=>auth()->id()]);
            $comment = Comment::create($validated->all());

            return redirect('users/'.$comment->post->user_id);
        }

        return back()->withErrors($request->errors());
    }
}

