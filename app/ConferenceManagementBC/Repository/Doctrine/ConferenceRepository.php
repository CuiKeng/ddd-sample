<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Repository\Doctrine;

use Doctrine\ORM\EntityRepository;
use App\ConferenceManagementBC\Domain\Repository\IConferenceRepository;
use App\ConferenceManagementBC\Domain\Model\Conference;
use Ramsey\Uuid\Uuid;
use App\Core\EventBus\IEventDispatcher;

class ConferenceRepository extends EntityRepository implements IConferenceRepository
{
    public function store(Conference $conference): void
    {
        $this->getEntityManager()->persist($conference);
        $this->getEntityManager()->flush();
        
        $eventDispatcher = app()->make(IEventDispatcher::class);
        $conference->getUncommittedEvents()->each(function ($item, $key) use ($eventDispatcher) {
            $eventDispatcher->fire($item);
        });
    }
    
    public function get(Uuid $uuid): ?Conference
    {
        return $this->find($uuid);
    }
}