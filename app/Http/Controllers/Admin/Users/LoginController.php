<?php

namespace App\Http\Controllers\Admin\Users;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index()
    {
        $title = 'Đăng Nhập Hệ Thống';

        return view('admin/users/login', compact('title'));
    }

    public function store(Request $request)
    {

        $rule = [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];

        $message = [
            'email.required' => 'Email bắt buộc nhập',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
        ];

        $request->validate($rule, $message);

        // Kiểm tra đã đăng nhập hay chưa và lưu đăng nhập
        if (
            Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ], $request->input('remember'))
        ) {
            return redirect()->route('admin');
        }

        Session::flash('error', 'Email hoặc password không chính sác');

        return redirect()->back();
        ;
    }
}