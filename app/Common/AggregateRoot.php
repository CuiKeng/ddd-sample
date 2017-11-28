<?php

declare(strict_types=1);

namespace App\Common;

use Illuminate\Support\Collection;

abstract class AggregateRoot implements IAggregateRoot
{
    private $uncommittedEvents;
    
    public function __construct()
    {
        $this->uncommittedEvents = Collection::make([]);
    }
    
    public function applyEvent(IEvent $event): void
    {
        $this->handle($event);
        
        $this->uncommittedEvents[] = $event;
    }
    
    public function getUncommittedEvents(): Collection
    {
        return $this->uncommittedEvents;
    }
    
    protected function handle(IEvent $event): void
    {
        $method = $this->getHandleMethod($event);
        
        if (! method_exists($this, $method)) {
            return;
        }
        
        $this->$method($event);
    }
    
    private function getHandleMethod(IEvent $event): string
    {
        $classParts = explode('\\', get_class($event));
        
        return 'handle' . end($classParts);
    }
}