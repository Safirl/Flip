<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\AppController::class)->group(function () {
    Route::get('/', 'index')->name('polls');
    Route::get('/{slug}/results', 'results')->name('results');
    Route::get('/notification', 'notification')->name('notification');
    Route::get('/account', 'account')->name('account');
    Route::get('/feed', 'feed')->name('feed');
});

Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
});

