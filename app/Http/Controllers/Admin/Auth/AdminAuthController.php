<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Admin\AdminController;
use App\Services\Admin\Auth\AdminAuthService;
use Illuminate\Http\Request;

class AdminAuthController extends AdminController
{
    public function login(Request $req) {
        if($req->ajax() && $req->isMethod('POST')) {
            return (new AdminAuthService())->login($req);
        }
        return view('admin.pages.auth.login');
    }

    public function logout() {
        $authService = new AdminAuthService();
        $authService->logout();

        RedirectRoute('admin.login');
    }
}
