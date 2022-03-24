<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Kiểm tra người dùng đã đăng nhập hay chưa
    // Nếu đã đăng nhập thì gửi biến "user" ra ngoài view
    // ===> Đã thay đổi bằng cách sử dụng if (Auth::check())
    /*public function __construct()
    {
        $this->DangNhap();
    }

    public function DangNhap() {
        if(Auth::check()) {
            view()->share("user", Auth::user());
        }
    }*/
}


