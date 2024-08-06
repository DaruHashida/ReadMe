<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Responses\SuccessResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Function createUser, which registers user
     *
     * @param  UserRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createUser(UserRequest $request)
    {
        //Validated
        $params = $request->safe();
        $params= $params->except('file');
        if ($request->hasFile('file')) {
            $avatar = $request->file('file');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('avatars/');
            $avatar->move($avatarPath, $avatarName);
            $avatar_name = 'avatars/' . $avatarName;
            $params= array_merge($params, ['avatar'=>$avatar_name]);
        }
        User::create($params);
        return redirect('/');
    }

    /**
     * Function loginUser, which authorizate user
     *
     * @param  LoginRequest $request
     * @return JsonResponse
     */
    public function loginUser(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/');
        }
        return redirect('/')->withErrors(
            [
            'password' => 'Неверный email или пароль',
            ]
        );
    }

    /**
     * Function logoutUser, which deletes access tokens
     *
     * @return SuccessResponse
     */
    public function logoutUser()
    {
        Auth::user()->tokens()->delete();
        Session::flush();
        return redirect('/');
    }
}
