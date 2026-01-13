<?php

namespace App\Services\Admin\Board;

use App\Models\Board;
use App\Models\BoardPosts;
use App\Services\Admin\AdminService;
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

        if($st) {
            $query->fullTextSearch($st);
        }

        $query->with('author');
        return $query->paginate($pagenate);
    }

}
