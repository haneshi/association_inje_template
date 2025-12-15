<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;

class AdminAuthController extends AdminController
{
    public function login() {
        return view('admin.pages.auth.login');
    }
}
