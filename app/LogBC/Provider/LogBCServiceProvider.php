<?php

declare(strict_types=1);

namespace App\LogBC\Provider;

use Illuminate\Support\ServiceProvider;
use App\LogBC\Saga\LogSaga;

class LogBCServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->make('events')->subscribe(LogSaga::class);
    }
}