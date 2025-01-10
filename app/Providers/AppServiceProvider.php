<?php

namespace App\Providers;

use App\Models\Friend;
use Illuminate\Support\Facades\Auth;
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
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $friendRequests = Friend::where('friend_id', Auth::id())
                    ->where('status', 'pending')
                    ->with('user')
                    ->get();
            } else {
                $friendRequests = collect(); 
            }
            $view->with('friendRequests', $friendRequests);
        });
    }
}
