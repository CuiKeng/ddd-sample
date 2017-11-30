<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Message;

class ConferenceCreatedMessage
{
    /**
     * @var string
     */
    private $uuid;
    
    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }
    
    public function getUuid(): string
    {
        return $this->uuid;
    }
}