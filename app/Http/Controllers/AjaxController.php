<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TheLoai;
use App\Models\LoaiTin;

class AjaxController extends Controller
{
    function getLoaiTin($idTheLoai)
    {
        $loaitin = LoaiTin::where("idTheLoai", $idTheLoai)->get();

        $html = "";
        foreach ($loaitin as $lt) {
            $html .= '<option value="' . $lt->id . '">' . $lt->Ten . '</option>';
        }

        echo $html;
    }

    function changeQuyen(Request $request) {
        $user = User::find($request->id);
        //  $user->quyen = $request->quyen;
        $user->quyen = ($user->quyen === 1) ? 0 : 1;
        $user->save();
//        return response()->json(['success' => 'Quyen đã được thay đổi thành công']);
        return response()->json(['id' => $request->id, "quyen" => $user->quyen, "success" => "Quyen đã được thay đổi thành công"]);
    }
}
