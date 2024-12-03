<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\AppController::class)->group(function () {
    Route::get('/', 'index')->name('polls');
    Route::get('/{slug}/results', 'results')->name('results');
    Route::get('/notification', 'notification')->name('notification');
    Route::get('/account', 'account')->name('account');
    Route::get('/feed', 'feed')->name('feed');
    Route::post('/account/add-friend', 'addFriend')->name('addFriend');
});

Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('auth.login');
    Route::post('/login','authenticate');
    Route::get('/register', 'register')->name('auth.register.show');
    Route::post('/register', 'createUser')->name('auth.register.create');
    Route::delete('/logout', 'logout')->name('auth.logout');
    Route::delete('/users/{user}', 'deleteUser')->name('auth.destroy');
});

