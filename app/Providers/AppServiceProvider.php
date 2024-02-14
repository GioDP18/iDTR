<?php

namespace App\Providers;

// services
use App\Http\Services\AuthService;
use App\Http\Services\AmDailyTimeRecordService;
use App\Http\Services\PmDailyTimeRecordService;

// implementations
use App\Http\Implementations\AuthServiceImpl;
use App\Http\Implementations\AmDailyTimeRecordServiceImpl;
use App\Http\Implementations\PmDailyTimeRecordServiceImpl;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{

    public $bindings = [
        AuthService::class => AuthServiceImpl::class,
        AmDailyTimeRecordService::class => AmDailyTimeRecordServiceImpl::class,
        PmDailyTimeRecordService::class => PmDailyTimeRecordServiceImpl::class,
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
