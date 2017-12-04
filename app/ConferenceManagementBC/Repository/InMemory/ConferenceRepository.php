<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Repository\InMemory;

use App\ConferenceManagementBC\Domain\Repository\IConferenceRepository;
use App\ConferenceManagementBC\Domain\Model\Conference;
use Illuminate\Support\Collection;
use App\Common\IEventDispatcher;
use Ramsey\Uuid\Uuid;

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
        $this->list[$conference->getUuid()->toString()] = $conference;
        
        $conference->getUncommittedEvents()->each(function ($item, $key) {
            $this->eventDispatcher->fire($item);
        });
    }
    
    public function get(Uuid $uuid): ?Conference
    {
        return $this->list[$uuid->toString()] ?? null;
    }
}