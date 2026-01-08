<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Services\Admin\Setting\AdminSettingService;

class AdminSettingController extends AdminController
{
    //

    /**
     * ============================================
     *  (Admin Account Management)
     * ============================================
     */
    public function adminIndex()
    {
        $dataService = new AdminSettingService();
        $this->data['admins'] = $dataService->getAdminList();
        return view('admin.pages.settings.manager.index', $this->data);
    }

    public function adminWrite()
    {
        $this->authorize('create', Admin::class);
        return view('admin.pages.settings.manager.write');
    }

    public function adminView(int $id)
    {
        $this->data['view'] = Admin::getData(['id' => $id]);

        if (!$this->data['view']) {
            RedirectRoute('admin.setting.manager');
        }

        if ($this->data['view']->id === config('auth.admin')->id || $this->data['view']->auth === 'D') {
            RedirectRoute('admin.setting.manager');
        }

        return view('admin.pages.settings.manager.view', $this->data);
    }

    /**
     * ============================================
     *  (Board Management)
     * ============================================
     */

    public function boardIndex() {
        $service = new AdminSettingService();
        $this->data['dataList'] = $service->getBoardList();
        return view('admin.pages.settings.board.index', $this->data);
    }

    public function data(Request $req)
    {
        if ($req->ajax() && $req->isMethod('POST')) {
            $dataService = new AdminSettingService();
            return match ($req->pType) {
                "checkUserId" => $dataService->checkUserId($req),
                "addAdmin" => $dataService->addAdmin($req),
                "setAdmin" => $dataService->setAdmin($req),
                "setPassword" => $dataService->setPassword($req),
            };
        }
    }
}
