<?php

Route::middleware(['auth:airlock'])->group(function () {
    Route::namespace('Category')->name('categories.')->group(function () {
        Route::get('categories', IndexCategoryHandler::class)->name('index');
        Route::post('categories', StoreCategoryHandler::class)->name('store');
        Route::put('categories/{category}', UpdateCategoryHandler::class)->name('update');
        Route::delete('categories/{category}', DestroyCategoryHandler::class)->name('destroy');
    });
});
Route::namespace('Auth')->name('auth.')->group(function () {
    Route::post('login', LoginHandler::class)->name('login');
    Route::post('register', RegisterHandler::class)->name('register');
    Route::post('logout', LogoutHandler::class)->name('logout')->middleware(['auth:airlock']);
});
