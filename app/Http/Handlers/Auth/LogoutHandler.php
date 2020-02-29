<?php

namespace App\Http\Handlers\Auth;

use Auth;
use Illuminate\Http\Request;

class LogoutHandler
{
    public function __invoke(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
