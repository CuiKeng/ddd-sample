<?php

declare(strict_types=1);

namespace App\CargoLogBC\Provider;

use Illuminate\Support\ServiceProvider;
use App\CargoLogBC\Saga\LogSaga;
use Illuminate\Contracts\Events\Dispatcher;

class LogBCServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        
    }
    
    public function boot(Dispatcher $dispatcher): void
    {
        $dispatcher->subscribe(LogSaga::class);
    }
}