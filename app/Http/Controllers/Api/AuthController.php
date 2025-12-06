<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Login
    public function login(Request $request)
    {
        $user = User::query()->where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'messsage'  => 'Email hoặc mật khẩu không đúng'
            ]);
        }

        //Tạo token để sử dụng cho các phiên làm việc
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'   => 'Đăng nhập thành công',
            'access_token'  => $token,
            'auth_type' => 'Bearer'
        ]);
    }

    //Đăng xuất
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message'   => "Bạn đã đăng xuất"
        ]);
    }

    //Đăng ký
    public function register(Request $request)
    {
        $data = $request->all();

        $user = User::query()->create($data); //tạo user

        //tạo token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'   => 'Đăng ký thành công',
            'access_token'  => $token,
        ]);
    }
}
