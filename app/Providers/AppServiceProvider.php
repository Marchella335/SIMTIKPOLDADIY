<?php

namespace App\Providers;

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
        // Force URL to use APP_URL (penting agar link di email benar)
        \Illuminate\Support\Facades\URL::forceRootUrl(config('app.url'));

        \Illuminate\Support\Facades\View::composer('layouts.admin', function ($view) {
            $expiringAnggotas = \App\Models\Anggota::whereNotNull('akhir_jabatan')
                ->where('akhir_jabatan', '<=', now()->addMonths(3))
                ->orderBy('akhir_jabatan', 'asc')
                ->get();
            $view->with('expiringAnggotas', $expiringAnggotas);
        });
    }
}
