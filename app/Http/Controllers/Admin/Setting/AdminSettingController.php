<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Services\Admin\Setting\AdminSettingService;

class AdminSettingController extends AdminController
{
    //
    public function index () {
        $dataService = new AdminSettingService();
        $this->data['admins'] = $dataService->getList();
        return view('admin.pages.member.index', $this->data);
    }

    public function write() {
        $this->authorize('create', Admin::class);

        return view('admin.pages.member.write');
    }
}
