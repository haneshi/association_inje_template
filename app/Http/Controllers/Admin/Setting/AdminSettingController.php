<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Services\Admin\Setting\AdminSettingService;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class AdminSettingController extends AdminController
{
    //
    public function index (Request $request) {
        $dataService = new AdminSettingService();
        $this->data['admins'] = $dataService->getPaginate();
        return view('admin.pages.member.index', $this->data);
    }
}
