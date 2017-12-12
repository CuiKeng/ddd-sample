<?php

declare(strict_types=1);

namespace App\PaymentBC\ProcessManager;

class PaymentProcessManager
{
    public function __construct()
    {
        
    }
    
    public function handleConferenceCreated(array $data): void
    {
        var_dump('halo');
    }
}