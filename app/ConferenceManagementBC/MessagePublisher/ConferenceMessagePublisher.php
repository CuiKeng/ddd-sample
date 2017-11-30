<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\MessagePublisher;

use App\ConferenceManagementBC\Domain\Event\ConferenceCreated;
use Illuminate\Events\Dispatcher;
use App\ConferenceManagementBC\Message\ConferenceCreatedMessage;
use App\Common\IEventDispatcher;

class ConferenceMessagePublisher
{
    private $messageDispatcher;
    
    public function __construct(Dispatcher $messageDispatcher)
    {
        $this->messageDispatcher = $messageDispatcher;
    }
    
    public function subscribe(IEventDispatcher $eventDispatcher)
    {
        $eventDispatcher->listen(
            'App\ConferenceManagementBC\Domain\Event\ConferenceCreated',
            'App\ConferenceManagementBC\MessagePublisher\ConferenceMessagePublisher@handleConferenceCreated'
        );
    }
    
    public function handleConferenceCreated(ConferenceCreated $event): void
    {
        $this->messageDispatcher->fire(app()->make(ConferenceCreatedMessage::class, [
            'uuid' => $event->getUuid()->toString()
        ]));
    }
}