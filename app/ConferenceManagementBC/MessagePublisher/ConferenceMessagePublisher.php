<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\MessagePublisher;

use App\ConferenceManagementBC\Domain\Event\ConferenceCreated;
use App\ConferenceManagementBC\Message\ConferenceCreatedMessage;
use App\Core\EventBus\IEventDispatcher;
use App\Core\MessageBus\IMessageDispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Broadcasting\Factory as BroadcastFactory;

class ConferenceMessagePublisher implements ShouldQueue
{
    /**
     * @var IMessageDispatcher
     */
    private $messageDispatcher;
    
    public function __construct(IMessageDispatcher $messageDispatcher)
    {
        $this->messageDispatcher = $messageDispatcher;
    }
    
    public function subscribe(IEventDispatcher $eventDispatcher)
    {
        $eventDispatcher->listen(
            ConferenceCreated::class,
            self::class . '@handleConferenceCreated'
        );
    }
    
    public function handleConferenceCreated(ConferenceCreated $event): void
    {
        $this->messageDispatcher->fire(app()->make(ConferenceCreatedMessage::class, [
            'uuid' => $event->getUuid()->toString()
        ]));
    }
}