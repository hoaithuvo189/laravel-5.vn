<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LoaiTin;

class Theloai extends Model
{
    use HasFactory;

    protected $table = "theloai";

    public function loaitin()
    {
        return $this->hasMany(LoaiTin::class, "idTheLoai", "id"); // 1 thể loại có nhiều loaitin
    }

    // get tin tức thông qua bảng loai tin
    function tintuc() {
        // App\LoaiTin là model trung gian để TheLoai liên kết với TinTuc
        // firstKey: idTheLoai (khóa ngoại, liên kết với idTheLoai trước)
        // secondKey: idLoaiTin (khóa ngoại, liên kết với idLoaiTin sau)
        // localKey: id (khóa chính của bảng theloai)
        // secondLocallKey: id (khóa chính của bảng tintuc)
        return $this->hasManyThrough(TinTuc::class, LoaiTin::class, "idTheLoai", "idLoaiTin", "id", "id");
    }
}
