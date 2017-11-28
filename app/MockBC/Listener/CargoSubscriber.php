<?php

namespace App\MockBC\Listener;

use Illuminate\Contracts\Queue\ShouldQueue;
use Psr\Log\LoggerInterface;
use App\CargoBC\Domain\CargoCreated;

class CargoSubscriber implements ShouldQueue
{
    /**
     * @var LoggerInterface
     */
    private $logger;
    
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    
    public function subscribe($event)
    {
        $event->listen(
            'App\CargoBC\Domain\CargoCreated',
            'App\MockBC\Listener\CargoSubscriber@onCargoCreated'
        );
    }
    
    public function onCargoCreated(CargoCreated $event)
    {
        $this->logger->info($event->getTrackingId()->toString());
    }
}