<?php

Route::middleware(['auth:airlock'])->group(function () {
    Route::post('logout', 'Auth\LogoutHandler');
});
Route::post('login', 'Auth\LoginHandler');
Route::post('register', 'Auth\RegisterHandler');
