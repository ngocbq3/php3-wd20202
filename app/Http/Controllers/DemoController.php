<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DemoController extends Controller
{
    public function index()
    {
        //Lấy dữ liệu của bảng posts
        $posts = DB::table('posts')
            ->paginate(10);
        return view('test', compact('posts'));
    }

    //Chi tiết bài viết
    public function show($id)
    {
        //Lấy ra 1 bản ghi theo id
        $post = DB::table('posts')
            ->where('id', $id)
            ->first();
        return view('detail', compact('post'));
    }
}
