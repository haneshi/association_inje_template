<?php

namespace App\Services\Admin\Setting;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Services\Admin\AdminService;

/**
 * Class AdminSettingService
 * @package App\Services
 */
class AdminSettingService extends AdminService
{
    public function getList()
    {
        $query = Admin::orderByRaw('is_active desc, seq asc');
        if (!config('auth.isDevel')) {
            if (!config('auth.isSuper')) {
                $query = $query->where('is_active', true);
            }
        }
        if (config('auth.isSuper') && !config('auth.isDevel')) {
            $query = $query->whereNot('id', config('auth.admin')->id);
        }
        $query = $query->whereNot('auth', 'D');
        return $query->get();
    }

    public function checkUserId(Request $req) {
        $data = $req->except('pType');
        $row = Admin::where('user_id', $data['value'])->withTrashed()->first();
        return $this->returnJsonData('hasUserId', (bool)$row);
    }
}
