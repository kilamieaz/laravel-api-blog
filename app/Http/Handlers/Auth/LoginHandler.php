<?php

namespace App\Http\Handlers\Auth;

use App\Jobs\AuthLogin;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreLoginRequest;

class LoginHandler
{
    public function __invoke(StoreLoginRequest $request)
    {
        $response = DB::transaction(function () use ($request) {
            $user = AuthLogin::dispatchNow($request->validated());
            $token = $user->createToken('auth:login');
            return [$user, $token];
        });
        list($user, $token) = $response;
        return (new UserResource($user))
        ->additional(['data' => ['accessToken' => $token->plainTextToken]]);
    }
}
