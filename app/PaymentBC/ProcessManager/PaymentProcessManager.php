<?php

declare(strict_types=1);

namespace App\PaymentBC\ProcessManager;

use App\Core\MessageBus\IMessageDispatcher;
use App\ConferenceManagementBC\Message\ConferenceCreatedMessage;

class PaymentProcessManager
{
    public function __construct()
    {
        
    }
    
    public function subscribe(IMessageDispatcher $messageDispatcher): void
    {
        $messageDispatcher->listen(
            ConferenceCreatedMessage::class,
            self::class . '@handleConferenceCreated'
        );
    }
    
    public function handleConferenceCreated(ConferenceCreatedMessage $conferenceCreatedMessage): void
    {
        var_dump(1);
    }
}