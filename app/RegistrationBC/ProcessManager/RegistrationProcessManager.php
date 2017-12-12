<?php

declare(strict_types=1);

namespace App\RegistrationBC\ProcessManager;

use App\Core\MessageBus\IMessageDispatcher;
use App\ConferenceManagementBC\Message\ConferenceCreatedMessage;

class RegistrationProcessManager
{
    public function __construct()
    {
    
    }
    
    public function subscribe(IMessageDispatcher $dispatcher): void
    {
        $dispatcher->listen(ConferenceCreatedMessage::class, self::class . '@handleConferenceCreated');
    }
    
    public function handleConferenceCreated(ConferenceCreatedMessage $message): void
    {
        var_dump('hahaha');
    }
}