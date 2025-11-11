<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        //Lấy danh sánh categories
        $categories = DB::table('categories')->get();
        //Nối bảng posts và categories
        $posts = DB::table('posts')
            ->join('categories', 'categories.id', 'posts.category_id')
            ->orderBy('posts.id', 'desc')
            ->limit(9)
            ->get(['posts.*', 'name']);

        return view('index', compact('posts', 'categories'));
    }
}
