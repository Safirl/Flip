<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\Polls\AnswerPollController;
use Illuminate\Support\Facades\Route;

Route::get('/account', [AccountController::class, 'show'])->name('account');

Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/{notification}', [NotificationsController::class, 'show'])->name('notifications.show');
});

Route::controller(\App\Http\Controllers\AppController::class)->group(function () {
    Route::get('/', 'index')->name('polls');
    Route::get('/mention', 'mentionslegales')->name('mentionslegales');
    Route::match(['get', 'post'], '/result/{poll:slug}', 'result')->name('app.result');
    Route::get('/feed', 'feed')->name('feed');
    Route::post('/account/add-friend', 'addFriend')->name('addFriend')->middleware('auth');

    // Comments
    Route::get('/comments/{poll:slug}', 'showComments')->name('comments.show')->middleware('auth');
    Route::post('/comments/{poll:slug}', 'addComment')->name('addComment')->middleware('auth');
});

Route::post('/polls/{poll:slug}/answer', AnswerPollController::class)
    ->name('polls.answer')
    ->middleware('auth');

Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('auth.login');
    Route::post('/login', 'authenticate');
    Route::get('/register', 'register')->name('auth.register.show');
    Route::post('/register', 'createUser')->name('auth.register.create');
    Route::delete('/logout', 'logout')->name('auth.logout');
    Route::delete('/users/{user}', 'deleteUser')->name('auth.destroy');
});

Route::controller(\App\Http\Controllers\AdminController::class)->group(function () {
    Route::get('/admin', 'index')->name('admin.index')->middleware('auth');
    Route::get('/create-poll', 'createPoll')->name('admin.create.poll')->middleware('auth');
    Route::get('edit-poll/{poll}', 'editPoll')->name('admin.edit.poll')->middleware('auth');
    Route::post('edit-poll/{poll}', 'updatePoll')->middleware('auth');
    Route::post('/create-poll', 'storePoll')->middleware('auth');
});
