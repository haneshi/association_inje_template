<?php

namespace App\Http\Controllers\Admin\Board;

use App\Models\Board;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Services\Admin\Board\AdminBoardPostService;

class AdminBoardPostController extends AdminController
{
    //

    private function getParamData(Request $req): array
    {
        return [
            'page' => $req->input('page', null),
            'id' => $req->input('id', null),
            'st' => $req->input('st', null),
        ];
    }

    public function index(Request $req, string $board_name)
    {
        $service = new AdminBoardPostService();
        $this->data['board'] = $service->getBoardData(['board_name' => $board_name]);
        $type = $this->data['board']->type;
        ## type 필요함 타입에 따라 뷰가 달라지게 마이그레이션 컬럼 타입 enum으로 바꿔야할듯
        $this->data['paramData'] = $this->getParamData($req);
        $this->data['dataList'] = $service->getPaginate($this->data['board']->id, $this->data, $this->data['board']->page_show_num);
        return view('admin.pages.board.' . $type . '.index', $this->data);
    }

    public function write(Request $req, string $board_name)
    {
        $this->data['paramData'] = $this->getParamData($req);
        $this->data['board'] = Board::getData(['board_name' => $board_name]);
        $type = $this->data['board']->type;
        return view('admin.pages.board.' . $type . '.write', $this->data);
    }

    public function data(Request $req, string $board_name)
    {
        if ($req->ajax() && $req->isMethod('post')) {
            $service = new AdminBoardPostService();
            $board = Board::getData(['board_name' => $board_name]);
            if (!$board) {
                return $this->returnJsonData('replace', route('admin.home'));
            }
            return match ($req->pType) {
                'addBoardPost' => $service->addBoardPost($req, $board),
            };
        }
    }
}
