<?php

namespace App\Providers;

use App\Models\Board;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // aside.blade.php에 게시판 데이터 자동 전달
        View::composer('admin.layouts.aside', function ($view) {
            $boards = Board::where('is_active', 1)
                ->orderBy('seq', 'asc')
                ->get(['id', 'board_name', 'type', 'title']);

            $view->with('boards', $boards);
        });
    }
}
