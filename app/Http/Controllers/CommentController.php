<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\TinTuc;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * @param $id
     * @param $idTinTuc
     * @return Application|RedirectResponse|Redirector
     */
    public function getXoa($id, $idTinTuc) {
        $comment = Comment::find($id);
        $comment->delete();

        return redirect("admin/tintuc/sua/" . $idTinTuc)->with("thongbao", "Bạn đã xóa commment thành công");
    }

    public function postComment(Request $request, $id) {
        $idTinTuc = $id;
        $tintuc = TinTuc::find($id);
        $comment = new Comment;
        $comment->idTinTuc = $idTinTuc;
        $comment->idUser = Auth::user()->id;
        $comment->Noidung = $request->NoiDung;
        $comment->save();

        return redirect("tintuc/" . $id . "/" . $tintuc->TieuDeKhongDau. ".html")->with("thongbao", "Viết bình luận thành công");
    }
}
