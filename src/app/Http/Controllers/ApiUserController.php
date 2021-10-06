<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\ApiRegisterRequest;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ApiUserController extends Controller
{
    //
    public function register(ApiRegisterRequest $request)
    {
        //echo "kslsaljas";
        //return view('home');
        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json($user);
    }

    public function login(ApiLoginRequest $request) {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            $user = User::whereEmail($request->email)->first();
            $user->token = $user->createToken('')->accessToken;
            return response()->json($user);
        }

        return response()->json(['email'=>'Sai tên truy cập hoặc mật khẩu'], 401);
    }

    public function userInfo(Request $request) {
        echo "auth user";
        return response()->json($request->user('api'));
    }
} 
