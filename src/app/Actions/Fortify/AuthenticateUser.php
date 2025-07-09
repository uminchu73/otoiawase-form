<?php

namespace App\Actions\Fortify;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse;

class AuthenticateUser
{
    public function __invoke(Request $request)
    {
        $request->validate(LoginRequest::$rules, LoginRequest::$messages);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials,
        $request->boolean('remember'))) {
            return null; // 認証失敗時はnullを返す
        }

        $request->session()->regenerate();

        //認証成功したユーザーを返す
        return Auth::user();
}
}
