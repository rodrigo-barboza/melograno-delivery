<?php

namespace App\Providers;

use App\Http\Services\Socialite\SocialiteDriver;
use App\Http\Services\Socialite\SocialiteService;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
