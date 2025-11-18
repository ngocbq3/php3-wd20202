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

Route::prefix('admin')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('admin.posts.index');
    //Thêm dữ liệu: form thêm
    Route::get('/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    //Thêm dữ liệu: thêm dữ liệu vào CSDL
    Route::post('/posts/create', [PostController::class, 'store'])->name('admin.posts.store');
    //Cập nhật: form cập nhật
    Route::get('/posts/{id}', [PostController::class, 'edit'])->name('admin.posts.edit');
    //Cập nhật dữ liệu vào CSDL
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('admin.posts.update');
    //Xóa dữ liệu
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('admin.posts.destroy');
    //Hiển thi chi tiết
    Route::get('/posts/{id}/show', [PostController::class, 'show'])->name('admin.posts.show');
});
