<?php

declare(strict_types=1);

namespace App\CargoBC\Domain\Cargo;

use App\Common\AggregateRoot;

class Cargo extends AggregateRoot
{
    /**
     * @var TrackingId
     */
    private $trackingId;
}