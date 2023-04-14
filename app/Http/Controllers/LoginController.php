<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    //
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);
    if (Auth::attempt($credentials)) {
        $token = $request->user()->createToken('login-token')->plainTextToken;

        return responseSuccess([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    // return response()->json(['error' => 'Unauthorized'], 401);
    return responseFail("Unauthorized",401);
}

public function test()
{
    return "ana test";
}

}
