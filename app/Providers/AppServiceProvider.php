<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrapFive();

        \Illuminate\Support\Facades\View::composer('layouts.admin', function ($view) {
            $expiringAnggotas = \App\Models\Anggota::whereNotNull('akhir_jabatan')
                ->where('akhir_jabatan', '<=', now()->addMonths(3))
                ->orderBy('akhir_jabatan', 'asc')
                ->get();
            $upcomingRencana = \App\Models\RencanaKegiatan::where('status', 'dijadwalkan')
                ->where('tanggal_rencana', '>=', now())
                ->where('tanggal_rencana', '<=', now()->addDays(14))
                ->orderBy('tanggal_rencana', 'asc')
                ->get();
            $view->with('expiringAnggotas', $expiringAnggotas);
            $view->with('upcomingRencana', $upcomingRencana);
        });
    }
}
