<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

//Sử dụng controller
Route::get('/demo', [DemoController::class, 'index']);

//Chi tiết bài viết
Route::get('/detail/{id}', [DemoController::class, 'show'])->name('posts.detail');
//Danh sách bài viết theo danh mục
Route::get('/category/{id}', [DemoController::class, 'list'])->name('posts.list');

Route::get('/admin/posts', [PostController::class, 'index']);
