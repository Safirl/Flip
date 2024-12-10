<?php

use Illuminate\Support\Facades\Route;


Route::controller(\App\Http\Controllers\AppController::class)->group(function () {
    Route::match(['get', 'post'], '/', 'index')->name('polls');
    Route::get('/mention', 'mentionslegales')->name('mentionslegales');
    Route::match(['get', 'post'], '/result/{poll:slug}',  'result')->name('app.result');
    Route::get('/notification', 'notification')->name('notification');
    Route::get('/account', 'account')->name('account');
    Route::get('/feed', 'feed')->name('feed');
    Route::post('/account/add-friend', 'addFriend')->name('addFriend')->middleware('auth');

    //Comments
    Route::get('/comments/{poll:slug}', 'showComments')->name('comments.show')->middleware('auth');
    Route::post('/comments/{poll:slug}', 'addComment')->name('addComment')->middleware('auth');
});

Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('auth.login');
    Route::post('/login','authenticate');
    Route::get('/register', 'register')->name('auth.register.show');
    Route::post('/register', 'createUser')->name('auth.register.create');
    Route::delete('/logout', 'logout')->name('auth.logout');
    Route::delete('/users/{user}', 'deleteUser')->name('auth.destroy');
});

Route::controller(\App\Http\Controllers\AdminController::class)->group(function () {
    Route::match(['get', 'post'], '/admin', 'index')->name('admin');
});
