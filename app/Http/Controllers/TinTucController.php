<?php

namespace App\Http\Controllers;

use App\Models\TinTuc;
use App\Models\TheLoai;
use App\Models\LoaiTin;
use Illuminate\Http\Request;

class TinTucController extends Controller
{
    public function getDanhSach() {
        $tintuc = TinTuc::orderBy("id", "DESC")->get();

        return view("admin.tintuc.danhsach", ["tintuc" => $tintuc]);
    }

    public function getThem() {
        $theloai = TheLoai::all();
//        $loaitin = LoaiTin::all();
        $loaitin = LoaiTin::where("idTheLoai", 1)->get(); // id = 1, mặc định

        return view("admin.tintuc.them", ["theloai" => $theloai, "loaitin" => $loaitin]);
    }

    public function postThem(Request $request) {
        $this->validate($request,
        [
            "LoaiTin" => "required",
            "TieuDe" => "required|min:3|unique:TinTuc, TieuDe", // unique:table,column
            "TomTat" => "required",
            "Noidung" => "required",
        ],
        [
            "LoaiTin.required" => "Bạn chưa chọn loại tin",
            "TieuDe.required" => "Bạn chưa chọn tiêu đề",
            "TieuDe.min" => "Tiêu đề phải có ít nhất 3 ký tự",
            "TieuDe.unique" => "Tiêu đề đã tồn tại",
            "TomTat.required" => "Bạn chưa nhập tóm tắt",
            "NoiDung.required" => "Bạn chưa nhập nội dung",
        ]
        );
        $idLoaiTin = $request->LoaiTin;

    }
}
