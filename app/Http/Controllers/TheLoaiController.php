<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\TheLoai;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 *
 */
class TheLoaiController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function getDanhSach() {
        $theloai = TheLoai::all();

        return view("admin.theloai.danhsach", ["theloai" => $theloai]);
    }

    /**
     * @return Application|Factory|View
     */
    public function getThem() {
        return view("admin.theloai.them");
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function postThem(Request $request) {
//        echo "<pre>";
//        print_r($request->Ten); // Ten là name="Ten" trong <input class="form-control" name="Ten" placeholder="Nhập tên thể loại" />
//        echo "</pre>";
        $this->validate($request,
            ["Ten" => "required|min:3|max:100|unique:TheLoai,Ten"],
            [
                "Ten.required" => "Bạn chưa nhập tên thể loại",
                "Ten.unique" => "Tên thể loại đã tồn tại",
                "Ten.min" => "Tên thể loại có độ dài từ 3 cho đến 100 ký tự",
                "Tên.max" => "Tên thể loại phải có độ dài từ 3 cho đến 100 ký tự",
            ]
        );

        $theloai = new TheLoai;
        $theloai->Ten = $request->Ten;
//        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->TenKhongDau = Str::slug($request->Ten);
        $theloai->save();

        return redirect("admin/theloai/them")->with("thongbao", "Thêm thành công"); // Add session key = "thongbao"
    }

    public function getSua($id) {
        $theloai = TheLoai::find($id);

        return view("admin.theloai.sua", ["theloai" => $theloai]);
    }

    public function postSua(Request $request, $id) {
        $this->validate($request,
            ["Ten" => "required|unique:TheLoai,Ten|min:3|max:100"],
            [
                "Ten.required" => "Bạn chưa nhập tên thể loại",
                "Ten.unique" => "Tên thể loại đã tồn tại",
                "Ten.min" => "Tên thể loại phải có độ dài từ 3 cho đến 100 ký tự",
                "Ten.max" => "Tên thể loại phải có độ dài từ 3 cho đến 100 ký tự"
            ]
        );

        $theloai = TheLoai::find($id);
        $theloai->Ten = $request->Ten;
//        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->TenKhongDau = Str::slug($request->Ten);
        $theloai->save();

        return redirect("admin/theloai/sua/" . $id)->with("thongbao", "Sửa thành công");
    }

    public function getXoa($id) {
        $theloai = TheLoai::find($id);
        $theloai->delete();

        return redirect("admin/theloai/danhsach")->with("thongbao", "Bạn đã xóa thành công");
    }
}
