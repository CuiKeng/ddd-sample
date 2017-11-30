<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Repository\InMemory;

use App\ConferenceManagementBC\Domain\Repository\IConferenceRepository;
use App\ConferenceManagementBC\Domain\Model\Conference;
use Illuminate\Support\Collection;
use App\Common\IEventDispatcher;

class ConferenceRepository implements IConferenceRepository
{
    /**
     * @var Dispatcher
     */
    private $eventDispatcher;
    
    /**
     * @var Collection
     */
    private $list;
    
    public function __construct(IEventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->list = Collection::make([]);
    }
    
    public function store(Conference $conference): void
    {
        $this->list[] = $conference;
        
        $conference->getUncommittedEvents()->each(function ($item, $key) {
            $this->eventDispatcher->fire($item);
        });
    }
}