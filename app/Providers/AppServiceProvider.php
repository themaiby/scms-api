<?php

namespace App\Providers;

use App\Models\Component;
use App\Models\Order;
use App\Models\OrderComponent;
use App\Observers\ComponentObserver;
use App\Observers\OrderComponentObserver;
use App\Observers\OrderObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Component::observe(ComponentObserver::class);
        Order::observe(OrderObserver::class);
        OrderComponent::observe(OrderComponentObserver::class);
    }
}
