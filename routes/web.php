<?php

use App\Presentation\Http\Controllers\Blog\HomeController;
use App\Presentation\Http\Controllers\Blog\PostController;
use App\Presentation\Http\Controllers\Blog\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('post')->group(function () {
    Route::get('/{external_id}', [PostController::class, 'show'])->name('post.show');
    Route::post('/{external_id}/like', [PostController::class, 'like'])->name('post.like');
    Route::post('/{external_id}/dislike', [PostController::class, 'dislike'])->name('post.dislike');
});

Route::prefix('user')->group(function () {
    Route::get('/{external_id}', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/{external_id}/posts', [UserController::class, 'posts'])->name('user.posts');
});
