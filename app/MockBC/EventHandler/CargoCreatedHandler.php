<?php

namespace App\MockBC\EventHandler;

use Illuminate\Contracts\Queue\ShouldQueue;
use Psr\Log\LoggerInterface;

class CargoCreatedHandler implements ShouldQueue
{
    private $logger;
    
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    
    public function handle($event)
    {
        $this->logger->info(get_class($event));
    }
}