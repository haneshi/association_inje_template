<?php

namespace App\Services\Admin\Board;

use App\Models\Board;
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

}
