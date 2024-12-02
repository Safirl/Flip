<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\AppController::class)->group(function () {
    Route::get('/', 'index')->name('polls');
    Route::get('/{slug}/results', 'results')->name('results');
    Route::get('/account', 'account')->name('account');
    Route::get('/activity', 'activity')->name('activity');
});

Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('auth.login');
    Route::post('/login','authenticate');
    Route::get('/register', 'register')->name('auth.register');
    Route::delete('/logout', 'logout')->name('auth.logout');
});

