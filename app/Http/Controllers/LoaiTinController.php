<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\LoaiTin;
use App\Models\TheLoai;
use Illuminate\Validation\ValidationException;

/**
 *
 */
class LoaiTinController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function getDanhSach() {
        $loaitin = LoaiTin::all();

        return view("admin.loaitin.danhsach", ["loaitin" => $loaitin]);
    }

    /**
     * @return Application|Factory|View
     */
    public function getThem() {
        $theloai = TheLoai::all();

        return view("admin.loaitin.them", ["theloai" => $theloai]);
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
            [
                "Ten" => "required|min:3|max:100|unique:LoaiTin,Ten",
                "TheLoai" => "required" // name of <input> "TheLoai" => "required" // name of <select> ],
            ],
            [
                "Ten.required" => "Bạn chưa nhập tên loại tin",
                "Ten.unique" => "Tên loại tin đã tồn tại",
                "Ten.min" => "Tên loại tin có độ dài từ 3 cho đến 100 ký tự",
                "Tên.max" => "Tên loại tin phải có độ dài từ 3 cho đến 100 ký tự",
                "TheLoai.required" => "Bạn chưa chọn thể loại"
            ]
        );

        $loaitin = new LoaiTin;
        $loaitin->Ten = $request->Ten; // Ten, TenKhongDau, idTheLoai: field trong database
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai; // "TheLoai" là tên <select>
        $loaitin->save();

        return redirect("admin/loaitin/them")->with("thongbao", "Thêm thành công"); // Add session key = "thongbao"
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function getSua($id) {
        $loaitin = LoaiTin::find($id);
        $theloai = TheLoai::all();

        return view("admin.loaitin.sua", ["loaitin" => $loaitin, "theloai" => $theloai]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function postSua(Request $request, $id) {
        $this->validate($request,
            [
                "Ten" => "required|unique:LoaiTin,Ten|min:3|max:100",
                "TheLoai" => "required" // name of <input> "TheLoai" => "required" // name of <select> ],
            ],
            [
                "Ten.required" => "Bạn chưa nhập tên loại tin",
                "Ten.unique" => "Tên loại tin đã tồn tại",
                "Ten.min" => "Tên loại tin phải có độ dài từ 3 cho đến 100 ký tự",
                "Ten.max" => "Tên loại tin phải có độ dài từ 3 cho đến 100 ký tự",
                "TheLoai.required" => "Bạn chưa chọn thể loại"
            ]
        );

        $loaitin = LoaiTin::find($id);
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();

        return redirect("admin/loaitin/sua/" . $id)->with("thongbao", "Sửa thành công");
    }

    /**
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function getXoa($id) {
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();

        return redirect("admin/loaitin/danhsach")->with("thongbao", "Bạn đã xóa thành công");
    }
}
