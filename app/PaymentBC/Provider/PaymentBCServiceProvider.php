<?php

declare(strict_types=1);

namespace App\PaymentBC\Provider;

use Illuminate\Support\ServiceProvider;
use App\PaymentBC\Console\Command\MessageLoopCommand;

class PaymentBCServiceProvider extends ServiceProvider
{
    protected $commands = [
        MessageLoopCommand::class
    ];
    
    public function register(): void
    {
        $this->registerCommands();
    }
    
    public function boot(): void
    {
        
    }
    
    private function registerCommands()
    {
        $this->commands($this->commands);
    }
}