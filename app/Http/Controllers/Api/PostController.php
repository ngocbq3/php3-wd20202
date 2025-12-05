<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    //lấy ra danh sách bài viết
    public function index()
    {
        $posts = Post::query()->paginate(10);
        return response()->json([
            'message' => 'Danh sách bài viết',
            'data'  => $posts,
        ], 200);
    }

    //thêm dữ liệu
    public function store(Request $request)
    {
        //Validator
        $validator = Validator::make(
            $request->all(),
            [
                'title' => ['required', 'string', 'max:255', 'unique:posts,title'],
                'content' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            ],
            [
                'title.required' => 'Tiêu đề không được để trống',
                'title.unique' => 'Tiêu đề đã tồn tại',
                'content.required' => 'Nội dung không được để trống',
                'category_id.required' => 'Danh mục không được để trống',
                'category_id.exists' => 'Danh mục không tồn tại',
                'image.image' => 'File tải lên phải là hình ảnh',
                'image.mimes' => 'Hình ảnh phải có định dạng: jpg, jpeg, png, gif',
                'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB',
            ]
        );

        //Kiểm tra validate, và gửi lại thông báo lỗi
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Dữ liệu lỗi',
                'errors'    => $validator->errors()
            ], 422);
        }
        //Trường hợp dữ liệu hợp lệ
        $data = $request->except('image');
        //Xử lý file
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images');
            $data['image'] = $image;
        }

        //Lưu dữ liệu vào database
        Post::query()->create($data);

        return response()->json([
            'message'   => 'Thêm dữ liệu thành công',
            'data'      => $data
        ], 201);
    }

    //Hiển thị chi tiết
    public function show($id)
    {
        $post = Post::query()->find($id);
        if ($post) {
            return response()->json([
                'data' => $post
            ], 200);
        }
        return response()->json([
            'message'   => 'Dữ liệu không tồn tại'
        ], 404);
    }

    //xóa dữ liệu
    public function destroy($id)
    {
        $post = Post::query()->find($id);
        if ($post) {
            $post->delete();
            return response()->json([
                'message'   => 'Xóa dữ liệu thành công',
                'data'      => $post
            ], 200);
        }
        return response()->json([
            'message'   => 'Dữ liệu không tồn tại'
        ], 404);
    }

    //Cập nhật dữ liệu
    public function update(Request $request, $id)
    {
        //validate
        $validator = Validator::make(
            $request->all(),
            [
                'title' => ['required', 'string', 'max:255', Rule::unique('posts', 'title')->ignore($id)],
                'content' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            ],
            [
                'title.required' => 'Tiêu đề không được để trống',
                'title.unique' => 'Tiêu đề đã tồn tại',
                'content.required' => 'Nội dung không được để trống',
                'category_id.required' => 'Danh mục không được để trống',
                'category_id.exists' => 'Danh mục không tồn tại',
                'image.image' => 'File tải lên phải là hình ảnh',
                'image.mimes' => 'Hình ảnh phải có định dạng: jpg, jpeg, png, gif',
                'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB',
            ]
        );

        //Kiểm tra validate, và gửi lại thông báo lỗi
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Dữ liệu lỗi',
                'errors'    => $validator->errors()
            ], 422);
        }

        $data = $request->except('image');
        $post = Post::query()->findOrFail($id);
        //Xử lý file
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images');
            $data['image'] = $image;
        }

        //Cập nhật dữ liệu vào database
        $post->update($data);

        return response()->json([
            'message'   => 'Cập nhật dữ liệu thành công',
            'data'      => $post,
        ], 200);
    }
}
