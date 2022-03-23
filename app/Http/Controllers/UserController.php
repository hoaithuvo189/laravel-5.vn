<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getDanhSach() {
        echo Auth::user();
        $user = User::all();
        return view("admin.user.danhsach", ["user" => $user]);
    }

    public function getThem() {
        return view("admin.user.them");
    }

    public function postThem(Request $request) {
        $this->validate($request, [
            "Name" => "required|min:3",
            "Email" => "required|email|unique:users,email", // unique:table,column (column trong bảng)
            "Password" => "required|min:3|max:32",
            "PasswordAgain" => "required|same:Password" // input PasswordAgain match với input Password
        ],[
            "Name.required" => "Bạn chưa nhập tên người dùng",
            "Name.min" => "Tên người dùng phải có ít nhất 3 ký tự",
            "Email.required" => "Bạn chưa nhập đúng email",
            "Email.email" => "Bạn chưa nhập đúng định dang email",
            "Password.required" => "Bạn chưa nhập mật khẩu",
            "Password.min" => "Mật khẩu phải có ít nhất 3 ký tự",
            "Password.max" => "Mật khẩu chỉ được tối đa 32 ký tự",
            "PasswordAgain.required" => "Bạn chưa nhập lại mật khẩu",
            "PasswordAgain.same" => "Mật khẩu nhập lại chưa chính xác"
        ]);

        $user = new User;
        $user->name = $request->Name;
        $user->email = $request->Email;
        $user->password = bcrypt($request->Password);
        $user->quyen = $request->Quyen;
        $user->save();

        return redirect("admin/user/them")->with("thongbao", "Thêm thành công");
    }

    public function getSua($id)
    {
        $user = User::find($id);

        return view("admin.user.sua", ["user" => $user]);
    }

    public function postSua(Request $request, $id) {
        $this->validate($request, [
            "Name" => "required|min:3",
        ],[
            "Name.required" => "Bạn chưa nhập tên người dùng",
            "Name.min" => "Tên người dùng phải có ít nhất 3 ký tự",
        ]);

        $user = User::find($id);
        $user->name = $request->Name;
        $user->quyen = $request->Quyen;

        if ($request->changePassword === "on") {
            $this->validate($request, [
                "Password" => "required|min:3|max:32",
                "PasswordAgain" => "required|same:Password" // input PasswordAgain match với input Password
            ],[
                "Password.required" => "Bạn chưa nhập mật khẩu",
                "Password.min" => "Mật khẩu phải có ít nhất 3 ký tự",
                "Password.max" => "Mật khẩu chỉ được tối đa 32 ký tự",
                "PasswordAgain.required" => "Bạn chưa nhập lại mật khẩu",
                "PasswordAgain.same" => "Mật khẩu nhập lại chưa chính xác"
            ]);

            $user->password = bcrypt($request->Password); // input name="Password"
        }

        $user->save();

        return redirect("admin/user/sua/" . $id)->with("thongbao", "Sửa thành công");
    }

    public function getXoa($id) {
        $user = User::find($id);
        $user->delete();

        return redirect("admin/user/danhsach")->with("thongbao", "Bạn đã xóa thành công");
    }

    public function getdangnhapAdmin() {
        return view("admin.login");
    }

    public function postdangnhapAdmin(Request $request) {
        $this->validate($request, [
            "email" => "required",
            "password" => "required|min:3|max:32",
        ], [
            "email.required" => "Bạn chưa nhập Email",
            "password.required" => "Bạn chưa nhập Password",
            "password.min" => "Password không được lớn hơn 32 ký tự"
        ]);

        // Kiểm tra email và password đã đúng chưa
        if (Auth::attempt(["email"=>$request->email, "password"=>$request->password])) {
            return redirect("admin/theloai/danhsach");
        }

        return redirect("admin/dangnhap")->with("thongbao", "Đăng nhập không thành cồng");
    }

    public function getdangxuatAdmin() {
        Auth::logout();
        return redirect("admin/dangnhap");
    }
}
