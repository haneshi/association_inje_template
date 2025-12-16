<?php

namespace App\Policies;

use App\Models\Admin;

class AdminPolicy
{
    /**
     * Create a new policy instance.

    public function __construct()
    {
        //
    }
     */

    /*
        D : 개발권한 | S : 최고관리자 | A : 일반관리자
    */

    // Only development rights and top management rights can generate an administrator ID
    public function create(Admin $admin) : bool
    {
        return in_array($admin->auth, ['D', 'S']);
    }
}
