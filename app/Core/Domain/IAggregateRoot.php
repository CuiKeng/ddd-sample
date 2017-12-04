<?php

declare(strict_types=1);

namespace App\Core\Domain;

interface IAggregateRoot extends IEntity
{
    public function applyEvent(IEvent $event);
    
    public function getUncommittedEvents();
}