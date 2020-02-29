<?php

namespace App\Http\Handlers\Auth;

use App\Jobs\AuthLogin;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class LoginHandler
{
    public function __invoke(Request $request)
    {
        $user = AuthLogin::dispatchNow($request->all());
        // $user = AuthLogin::dispatchNow($request->validated());
        // $user = dispatch(new AuthLogin($request));

        return UserResource::collection($user)
        ->additional(['message' => 'User retrieved successfully',
        ]);
    }
}
