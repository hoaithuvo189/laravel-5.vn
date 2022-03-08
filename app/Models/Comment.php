<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = "comment";

    public function tintuc() {
        return $this->belongsTo(TinTuc::class, "idTinTuc", "id");
    }

    public function user() {
        return $this->belongsTo(User::class, "idUser", "id");
    }
}
