<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = "comment";

    // Mối quan hệ
    public function tintuc() {
        return $this->belongsTo(TinTuc::class, "idTinTuc", "id");
    }

    // Mối quan hệ
    public function user() {
        return $this->belongsTo(User::class, "idUser", "id");
    }
}
