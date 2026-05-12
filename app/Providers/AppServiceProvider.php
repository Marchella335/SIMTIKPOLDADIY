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
        \Illuminate\Support\Facades\View::composer('layouts.admin', function ($view) {
            $expiringAnggotas = \App\Models\Anggota::whereNotNull('akhir_jabatan')
                ->where(function($q) {
                    $q->whereNull('akhir_jabatan_notif')
                      ->orWhereColumn('akhir_jabatan', '!=', 'akhir_jabatan_notif');
                })
                ->where('akhir_jabatan', '<=', now()->addMonths(3))
                ->where('akhir_jabatan', '>=', now()->subDays(30))
                ->orderBy('akhir_jabatan', 'asc')
                ->get();
            $view->with('expiringAnggotas', $expiringAnggotas);
        });
    }
}
