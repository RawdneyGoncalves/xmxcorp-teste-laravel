<?php

use App\Presentation\Http\Controllers\Blog\HomeController;
use App\Presentation\Http\Controllers\Blog\PostController;
use App\Presentation\Http\Controllers\Blog\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');
Route::post('/post/{id}/like', [PostController::class, 'like'])->name('post.like');
Route::post('/post/{id}/dislike', [PostController::class, 'dislike'])->name('post.dislike');

Route::get('/user/{id}', [UserController::class, 'profile'])->name('user.profile');
Route::get('/user/{id}/posts', [UserController::class, 'posts'])->name('user.posts');
