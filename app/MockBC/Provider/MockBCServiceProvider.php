<?php

namespace App\MockBC\Provider;

use Illuminate\Support\ServiceProvider;
use App\MockBC\Listener\CargoSubscriber;

class MockBCServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->make('events')->subscribe(CargoSubscriber::class);
    }
}