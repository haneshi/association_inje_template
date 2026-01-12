<?php

namespace App\Http\Controllers\Admin\Board;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Services\Admin\Board\AdminBoardPostService;

class AdminBoardPostController extends AdminController
{
    //

    public function index(Request $req, string $board_name)
    {
        $service = new AdminBoardPostService();

        $this->data['board'] = $service->getBoardData(['board_name' => $board_name]);
        $type = $this->data['board']->type;
        ## type 필요함 타입에 따라 뷰가 달라지게 마이그레이션 컬럼 타입 enum으로 바꿔야할듯
        return view('admin.pages.board.'. $type .'.index', $this->data);
    }
}
