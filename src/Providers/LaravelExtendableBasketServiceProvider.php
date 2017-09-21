<?php
namespace DivineOmega\LaravelExtendableBasket\Providers\ServiceProvider;

use Illuminate\Support\ServiceProvider;

class LaravelExtendableBasketServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }
}