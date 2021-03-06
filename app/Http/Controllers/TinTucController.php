<?php

namespace App\Http\Controllers;

use App\Models\TinTuc;
use App\Models\TheLoai;
use App\Models\LoaiTin;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            "TieuDe" => "required|min:3|unique:TinTuc,TieuDe", // unique:table,column
            "TomTat" => "required",
            "NoiDung" => "required",
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

        $tintuc = new TinTuc;
        $tintuc->TieuDe = $request->TieuDe; // Lưu input TieuDe vào column TieuDe trong bảng
//        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->TieuDeKhongDau = Str::slug($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;
        $tintuc->SoLuotXem = 0;

        if ($request->hasFile("Hinh")) {
            $file = $request->file("Hinh");
            // Kiểm tra đuôi file
            $duoi = $file->getClientOriginalExtension();

            if ($duoi != "jpg" && $duoi != "png" && $duoi != "jpeg") {
                return redirect("admin/tintuc/them")->with("loi", "Bạn chỉ được chọn file có đuôi jpg, png, jpeg");
            }

            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4) . "_" . $name;

            // Nếu trùng thì tiếp tục random
            while(file_exists("upload/tintuc/" . $Hinh)) {
                $Hinh = Str::random(4) . "_" . $name;
            }

            $file->move("upload/tintuc", $Hinh);
            $tintuc->Hinh = $Hinh;

        } else {
            $tintuc->Hinh = "";
        }

        $tintuc->save();

        return redirect("admin/tintuc/them")->with("thongbao", "Thêm tin thành công");
    }

    public function getSua($id) {
        $tintuc = TinTuc::find($id);
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();

        return view("admin.tintuc.sua", ["tintuc" => $tintuc, "theloai" => $theloai, "loaitin" => $loaitin]);
    }

    public function postSua(Request $request, $id) {
        $tintuc = TinTuc::find($id);

        $this->validate($request,
            [
                "LoaiTin" => "required",
                "TieuDe" => "required|min:3|unique:TinTuc,TieuDe", // unique:table,column
                "TomTat" => "required",
                "NoiDung" => "required",
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

        $tintuc->TieuDe = $request->TieuDe; // Lưu input TieuDe vào column TieuDe trong bảng
//        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->TieuDeKhongDau = Str::slug($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;
        $tintuc->SoLuotXem = 0;

        if ($request->hasFile("Hinh")) {
            $file = $request->file("Hinh");
            // Kiểm tra đuôi file
            $duoi = $file->getClientOriginalExtension();

            if ($duoi != "jpg" && $duoi != "png" && $duoi != "jpeg") {
                return redirect("admin/tintuc/them")->with("loi", "Bạn chỉ được chọn file có đuôi jpg, png, jpeg");
            }

            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4) . "_" . $name;

            // Nếu trùng thì tiếp tục random
            while(file_exists("upload/tintuc/" . $Hinh)) {
                $Hinh = Str::random(4) . "_" . $name;
            }

            $file->move("upload/tintuc", $Hinh);

            // Xóa hình cũ đi
            unlink("upload/tintuc/" . $tintuc->Hinh);

            $tintuc->Hinh = $Hinh;
        }

        $tintuc->save();

        return redirect("admin/tintuc/sua/" . $id)->with("thongbao", "Sửa tin thành công");
    }

    public function getXoa($id) {
        $tintuc = TinTuc::find($id);
//        $tintuc->comment($id)->delete();
        $tintuc->delete();

        return redirect("admin/tintuc/danhsach")->with("thongbao", "Xóa thành công");
    }
}
