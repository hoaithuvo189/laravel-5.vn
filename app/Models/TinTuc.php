<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    use HasFactory;

    protected $table = "tintuc";

    // 1 tin tức thuộc 1 loại tin
    public function loaitin() {
        return $this->belongsTo(LoaiTin::class, "idLoaiTin", "id");
    }

    public function comment() {
        return $this->hasMany(Comment::class, "idTinTuc", "id");
    }
}
