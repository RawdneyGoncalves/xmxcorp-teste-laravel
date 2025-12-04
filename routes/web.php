<?php

use App\Presentation\Http\Controllers\Blog\HomeController;
use App\Presentation\Http\Controllers\Blog\PostController;
use App\Presentation\Http\Controllers\Blog\UserController;
use App\Presentation\Http\Controllers\Blog\StatusController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::post('/post', [PostController::class, 'store'])->name('post.store');

Route::prefix('post')->group(function () {
    Route::get('/{external_id}', [PostController::class, 'show'])
        ->where('external_id', '[0-9]+')
        ->name('post.show');
    Route::post('/{external_id}/like', [PostController::class, 'like'])
        ->where('external_id', '[0-9]+')
        ->name('post.like');
    Route::post('/{external_id}/dislike', [PostController::class, 'dislike'])
        ->where('external_id', '[0-9]+')
        ->name('post.dislike');
});

Route::prefix('user')->group(function () {
    Route::get('/{external_id}', [UserController::class, 'profile'])
        ->where('external_id', '[0-9]+')
        ->name('user.profile');
    Route::get('/{external_id}/posts', [UserController::class, 'posts'])
        ->where('external_id', '[0-9]+')
        ->name('user.posts');
});

Route::get('/status', [StatusController::class, 'check'])->name('status.check');
