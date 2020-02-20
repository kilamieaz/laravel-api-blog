<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', function (Request $request) {
    $email = $request->email;
    $password = $request->password;

    if (Auth::attempt([
        'email' => $email,
        'password' => $password
    ])) {
        return response()->json('', 204);
    } else {
        return response()->json([
            'error' => 'invalid_credentials'
        ], 403);
    }
});
