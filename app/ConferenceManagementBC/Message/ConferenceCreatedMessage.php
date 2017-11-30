<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Message;

class ConferenceCreatedMessage
{
    /**
     * @var string
     */
    private $conferenceId;
    
    public function __construct(string $conferenceId)
    {
        $this->conferenceId = $conferenceId;
    }
    
    public function getConferenceId(): string
    {
        return $this->conferenceId;
    }
}