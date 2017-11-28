<?php

declare(strict_types=1);

namespace App\CargoBC\Domain;

use App\Common\AggregateRoot;

class Cargo extends AggregateRoot
{
    /**
     * @var TrackingId
     */
    private $trackingId;
    
    public function __construct(TrackingId $trackingId)
    {
        parent::__construct();
        
        $this->applyEvent(new CargoCreated($trackingId));
    }
    
    public function getTrackingId(): TrackingId
    {
        return $this->trackingId;
    }
    
    public function handleCargoCreated(CargoCreated $event): void
    {
        $this->trackingId = $event->getTrackingId();
    }
}