<?php

declare(strict_types=1);

namespace App\CargoLogBC\Saga;

use Illuminate\Contracts\Queue\ShouldQueue;
use Psr\Log\LoggerInterface;
use App\CargoBC\Domain\CargoCreated;

class LogSaga implements ShouldQueue
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
            'App\CargoLogBC\Saga\LogSaga@onCargoCreated'
        );
    }
    
    public function onCargoCreated(CargoCreated $event)
    {
        // 触发命令
        $this->logger->info($event->getTrackingId()->toString());
    }
}