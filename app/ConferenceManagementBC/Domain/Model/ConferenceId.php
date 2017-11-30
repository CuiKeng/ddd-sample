<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Domain\Model;

use App\Common\IValueObject;
use Ramsey\Uuid\Uuid;

class ConferenceId implements IValueObject
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
    
    public function __toString()
    {
        return $this->toString();
    }
}