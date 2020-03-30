<?php

namespace App\Http\Handlers\Auth;

use App\Jobs\CreateUser;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreRegisterRequest;

class RegisterHandler
{
    public function __invoke(StoreRegisterRequest $request)
    {
        $response = DB::transaction(function () use ($request) {
            $user = CreateUser::dispatchNow($request->validated());
            $token = $user->createToken('auth:login');
            return [$user, $token];
        });
        list($user, $token) = $response;
        return (new UserResource($user))
        ->additional(['data' => ['accessToken' => $token->plainTextToken]]);
    }
}
