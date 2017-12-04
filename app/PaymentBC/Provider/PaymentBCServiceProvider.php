<?php

declare(strict_types=1);

namespace App\PaymentBC\Provider;

use Illuminate\Support\ServiceProvider;
use App\Core\MessageBus\IMessageDispatcher;
use App\PaymentBC\ProcessManager\PaymentProcessManager;

class PaymentBCServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        
    }
    
    public function boot(IMessageDispatcher $messageDispatcher): void
    {
        $messageDispatcher->subscribe(PaymentProcessManager::class);
    }
}