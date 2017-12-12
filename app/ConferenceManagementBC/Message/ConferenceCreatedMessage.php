<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Message;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Broadcasting\Channel;

class ConferenceCreatedMessage implements ShouldBroadcast
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
    
    public function broadcastOn()
    {
        return new Channel('conference-created');
    }
    
    public function broadcastWith()
    {
        return [
            'uuid' => $this->uuid
        ];
    }
}