<?php

declare(strict_types=1);

namespace App\RegistrationBC\Provider;

use Illuminate\Support\ServiceProvider;
use App\Core\MessageBus\IMessageDispatcher;
use App\RegistrationBC\ProcessManager\RegistrationProcessManager;

class RegistrationBCServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        
    }
    
    public function boot(IMessageDispatcher $dispatcher): void
    {
        $dispatcher->subscribe(RegistrationProcessManager::class);
    }
}