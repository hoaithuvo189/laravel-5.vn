<?php

namespace App\Http\Controllers;

use App\Models\LoaiTin;
use App\Models\TheLoai;
use App\Models\Slide;
use App\Models\TinTuc;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function __construct()
    {
        $theloai = TheLoai::all();
        $slide = Slide::all();
        view()->share("theloai", $theloai); // Tất cả page gọi PagesController đều có thể dùng biến $theloai
        view()->share("slide", $slide); // Tất cả page gọi PagesController đều có thể dùng biến $slide

        // Kiểm tra người dùng đã đăng nhập chưa  ====> Đã thay đổi sử dụng if (auth()->check())
//        if(Auth::check()) {
//            view()->share("nguoidung", Auth::user());
            // Hiển thị biến "nguoidung" lên view nếu người dùng đã đăng nhập,
            // ở view kiểm tra biến "nguoidung" đã có chưa, nếu có nghĩa là đã đăng nhập
//        }
    }

    public function trangchu() {
        return view("pages.trangchu");
    }

    public function lienhe() {
        return view("pages.lienhe");
    }

    public function loaitin($id) {
        $loaitin = LoaiTin::find($id); // Tìm loại tin có id
        $tintuc = TinTuc::where("idLoaitin", $id)->paginate(5);

        return view("pages.loaitin", ["loaitin" => $loaitin, "tintuc" => $tintuc]);
    }

    public function tintuc($id) {
        $tintuc = TinTuc::find($id); // Tìm loại tin có id
        $tinnoibat = TinTuc::where("NoiBat",1)->whereNotIn("id",[$id])->take(4)->get(); // Không bao gồm $id
        $tinlienquan = TinTuc::where("idLoaiTin",$tintuc->idLoaiTin)->whereNotIn("id",[$id])->take(4)->get();  // Không bao gồm $id

        return view("pages.tintuc", ["tintuc" => $tintuc, "tinnoibat" => $tinnoibat, "tinlienquan" => $tinlienquan]);
    }

    public function getdangnhap() {
        return view("pages.dangnhap");
    }

    public function postdangnhap(Request $request) {
        $this->validate($request, [
            "email" => "required",
            "password" => "required|min:3|max:32",
        ], [
            "email.required" => "Bạn chưa nhập Email",
            "password.required" => "Bạn chưa nhập Password",
            "password.min" => "Password không được lớn hơn 32 ký tự"
        ]);

        // Kiểm tra email và password đã giống trong bảng database hay không
        if (Auth::attempt(["email"=>$request->email, "password"=>$request->password])) {
//            return redirect("trangchu");
            return redirect()->route("trangchu");
        }

        return redirect("dangnhap")->with("thongbao", "Đăng nhập không thành cồng");
    }

    public function getDangXuat() {
        Auth::logout();
//        return redirect("trangchu");
        return redirect()->route("trangchu");
    }

    public function getNguoiDung() {

        return view("pages.nguoidung");
    }

    public function postNguoiDung(Request $request) {
        $this->validate($request, [
            "Name" => "required|min:3",
        ],[
            "Name.required" => "Bạn chưa nhập tên người dùng",
            "Name.min" => "Tên người dùng phải có ít nhất 3 ký tự",
        ]);

        $user = Auth::user();
        $user->name = $request->Name;

        if ($request->changePassword === "on") { // Nếu check vào Đổi mật khẩu
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

        return redirect("/nguoidung")->with("thongbao", "Sửa người dùng thành công");
    }


    public function getDangky() {
        return view("pages.dangky");
    }

    public function postDangky(Request $request) {
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
        $user->quyen = 0;
        $user->save();

        return redirect("dangnhap")->with("thongbao", "Chúc mừng bạn đăng ký thành công");
    }

    public function timkiem(Request $request) {
        $tukhoa = $request->tukhoa;
        $tintuc = TinTuc::where("TieuDe", "like", "%$tukhoa%")
                ->orWhere("TomTat", "like", "%$tukhoa%")
                ->orWhere("NoiDung","like","%$tukhoa%")->take(30)->paginate(5);

        return view("pages.timkiem", ["tintuc" => $tintuc, "tukhoa" => $tukhoa]);
    }
}
