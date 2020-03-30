<?php

namespace App\Http\Handlers\Auth;

use Auth;

class LogoutHandler
{
    public function __invoke()
    {
        $user = Auth::user();
        $user->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
