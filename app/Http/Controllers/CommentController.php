<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

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
}
