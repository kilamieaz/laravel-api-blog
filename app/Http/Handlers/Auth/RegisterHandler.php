<?php

namespace App\Http\Handlers\Auth;

use App\Jobs\CreateUser;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class RegisterHandler
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user = CreateUser::dispatchNow($request->all());

        return new UserResource($user);
    }
}
