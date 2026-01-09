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
        dd($this->data);
    }
}
