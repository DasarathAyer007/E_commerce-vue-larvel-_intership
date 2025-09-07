<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use App\Models\Order;
use App\Models\User;


use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
         App\Models\Order::class => App\Policies\OrderPolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Gate::define('pay-order', function (User $user, Order $order) {
        //     return true;
        // });
    }
}
