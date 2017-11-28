<?php

declare(strict_types=1);

namespace App\CargoBC\Command;

use Ramsey\Uuid\Uuid;

class CreateCargoCommand
{
    /**
     * @var Uuid
     */
    private $uuid;
    
    public function __construct(Uuid $uuid)
    {
        $this->uuid = $uuid;
    }
    
    public function getUuid(): Uuid
    {
        return $this->uuid;
    }
}