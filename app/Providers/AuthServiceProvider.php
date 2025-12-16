<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Admin;
use App\Policies\AdminPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        Admin::class => AdminPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        $this->registerPolicies();
        Auth::shouldUse('admin'); // policy 가 기본 web 가드를 바라봐서 admin 가드를 바라보라고 설정
    }
}
