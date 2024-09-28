<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Item;
use App\Models\User;
use app\Policies\ItemPolicy;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Item::class => ItemPolicy::class,
    ];
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Paginator::useBootstrap();
        $this->register();

        // Gate untuk mengelola Item (Hanya supplier yang boleh mengelola item)
         Gate::define('manage-item', function (User $user) {
             return $user->role === 'supplier';
         });

        // Gate untuk membeli barang (Hanya pelanggan yang boleh membeli item)
        Gate::define('buy-item', function (User $user) {
            return $user->role === 'pelanggan';
        });
    }
}
