<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiTin extends Model
{
    use HasFactory;

    protected $table = "loaitin";

    // get thể loại (loại tin thuộc thể loại nào)
    public function theLoai() { // "theloai" lấy tên từ models TheLoai
        return $this->belongsTo(TheLoai::class, "idTheLoai", "id");
    }

    // get tin tức
    public function tintuc() { // "tintuc" lấy tên từ models TinTuc
        return $this->hasMany(TinTuc::class, "idLoaiTin", "id");
    }
}
