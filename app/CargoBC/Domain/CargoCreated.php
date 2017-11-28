<?php

declare(strict_types=1);

namespace App\CargoBC\Domain;

use App\Common\IEvent;

class CargoCreated implements IEvent
{
    /**
     * @var TrackingId
     */
    private $trackingId;
    
    public function __construct(TrackingId $trackingId)
    {
        $this->trackingId = $trackingId;
    }
    
    public function getTrackingId(): TrackingId
    {
        return $this->trackingId;
    }
}