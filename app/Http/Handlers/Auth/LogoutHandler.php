<?php

namespace App\Http\Handlers\Auth;

use Auth;

class LogoutHandler
{
    public function __invoke()
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
