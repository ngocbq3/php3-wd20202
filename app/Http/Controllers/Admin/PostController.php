<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        //Lấy dữ liệu
        $posts = Post::with('category')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }
}
