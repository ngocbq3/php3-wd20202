<?php

use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//ĐỊnh nghĩa đường dẫn cho website
Route::get('/about', function () {
    return "Trang giới thiệu";
});
Route::get('/contact', function () {
    return "Trang liên hệ";
});

//ĐỊnh tham số trong đường dẫn
Route::get('/users/{id}', function ($id) {
    return "User id = $id";
});
//ĐỊnh nghĩa điều kiện cho tham số
Route::get("/products/{slug}/comment/{id}", function ($slug, $id) {
    return "Comment id: $id, trong Product: $slug";
})->name('products.comment')
    ->where(['slug' => '[a-zA-z]+', 'id' => '[0-9]+']);

//Nhóm đường dẫn có tiền tố giống nhau
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/customer', function () {
        return "Trang quản trị người dùng";
    })->name('users');
    Route::get('/productsadasdfsa', function () {
        return "Trang quản trị sản phẩm";
    })->name('products');
});

//Sử dụng controller
Route::get('/demo', [DemoController::class, 'index']);
