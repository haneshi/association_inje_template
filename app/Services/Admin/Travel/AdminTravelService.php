<?php

namespace App\Services\Admin\Travel;

use App\Models\Travel;
use App\Services\Admin\AdminService;
/**
 * Class AdminTravelService
 * @package App\Services
*/
class AdminTravelService extends AdminService
{
    public function getList(array $arrData)
    {
        $st = $arrData['paramData']['st'];
        $query = Travel::orderByRaw('is_active desc, seq asc');
        if($st) {
            $query = $query->where(function ($q) use ($st) {
                $q->orWhere('name', 'LIKE', "%{$st}%");
            });
        }

        return $query->get();
    }
}
