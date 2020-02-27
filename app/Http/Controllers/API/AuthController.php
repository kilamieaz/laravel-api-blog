<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Jobs\AuthLogin;
use App\Jobs\CreateUser;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class AuthController
{
    public function login(Request $request)
    {
        $user = AuthLogin::dispatchNow($request->all());
        // $user = dispatch(new AuthLogin($request));

        return UserResource::collection($user)
        ->additional(['message' => 'User retrieved successfully',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user = CreateUser::dispatchNow($request->all());

        return new UserResource($user);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
