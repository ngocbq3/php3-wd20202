<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
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

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {

        $data = $request->except('image');

        //Xử lý file
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images');
            $data['image'] = $image;
        }

        //Lưu dữ liệu vào database
        Post::query()->create($data);
        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Thêm dữ liệu thành công');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('admin.posts.edit', compact('categories', 'post'));
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $data = $request->except('image');

        //Xử lý file
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images');
            $data['image'] = $image;
        }

        //Cập nhật dữ liệu vào database
        $post->update($data);
        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Cập nhật dữ liệu thành công');
    }
}
