<?php

namespace App\Services\Admin\Board;

use App\Models\Admin;
use App\Models\Board;
use App\Models\BoardPosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\Admin\AdminService;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminBoardPostService
 * @package App\Services
 */
class AdminBoardPostService extends AdminService
{

    public function getBoardData(array $where = [])
    {
        return Board::getData($where);
    }

    public function getPaginate(int $board_id, array $arrData, int $pagenate = 10)
    {
        $st = $arrData['paramData']['st'];

        $query = BoardPosts::where('board_id', $board_id)
            ->orderByRaw('is_fixed desc, created_at desc');

        if ($st) {
            $query->fullTextSearch($st);
        }

        $query->with('author');
        return $query->paginate($pagenate);
    }

    public function addBoardPost(Request $req, Model $board)
    {
        $data = $req->except(['pType']);
        $data['board_id'] = $board->id;
        $data['author_id'] = config('auth.admin')->id;
        $data['author_type'] = Admin::class;
        $data['is_fixed'] = $req->boolean('is_fixed');
        $data['ip'] = $req->ip();
        $data['is_active'] = $req->boolean('is_active');

        try {
            if ($board->posts()->create($data)) {
                return $this->returnJsonData('toastAlert', [
                    'type' => 'success',
                    'delay' => 1000,
                    'delayMask' => true,
                    'content' => "게시글이 추가 되었습니다..",
                    'event' => [
                        'type' => 'replace',
                        'url' => route('admin.board', $board->board_name),
                    ],
                ]);
            }
        } catch (\Exception $e) {
            $boardLog = new Board();
            $boardLog->setHistoryLog([
                'type' => 'error',
                'description' => "게시글 추가 에러",
                'queryData' => $this->json_encode($data),
                'rowData' => JsonEncode(['error' => $e->getMessage()]),
            ], $this->user());

            return $this->returnJsonData('modalAlert', [
                'type' => 'error',
                'title' => "게시글 추가 에러",
                'content' => "게시글이 추가 되지 않았습니다. <br> 관리자에게 문의해 주세요!",
            ]);
        }
    }
}
