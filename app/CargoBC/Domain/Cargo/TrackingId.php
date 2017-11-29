<?php

declare(strict_types=1);

namespace App\CargoBC\Domain\Cargo;

use App\Common\IValueObject;
use Ramsey\Uuid\Uuid;

class TrackingId implements IValueObject
{
    /**
     * @var Uuid
     */
    private $uuid;
    
    public function __construct(Uuid $uuid)
    {
        $this->uuid = $uuid;
    }
    
    public function toString(): string
    {
        return $this->uuid->toString();
    }
    
    public function __toString(): string
    {
        return $this->toString();
    }
}