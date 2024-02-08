<?php

namespace App\Providers;

// services
use App\Http\Services\AuthService;

// implementations
use App\Http\Implementations\AuthServiceImp;

use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{

    public $bindings = [
        AuthService::class => AuthServiceImp::class,
    ];
    
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
        //
    }
}
