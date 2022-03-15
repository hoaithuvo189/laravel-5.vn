<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;
use App\Models\LoaiTin;

class AjaxController extends Controller
{
    function getLoaiTin($idTheLoai) {
        $loaitin = LoaiTin::where("idTheLoai", $idTheLoai)->get();

        $html = "";
        foreach ($loaitin as $lt) {
            $html .= '<option value="' . $lt->id . '">' . $lt->Ten . '</option>';
        }

        echo $html;
    }
}
