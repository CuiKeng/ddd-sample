<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Repository\Doctrine;

use Doctrine\ORM\EntityRepository;
use App\ConferenceManagementBC\Domain\Repository\IConferenceRepository;
use App\ConferenceManagementBC\Domain\Model\Conference;
use Ramsey\Uuid\Uuid;

class ConferenceRepository extends EntityRepository implements IConferenceRepository
{
    public function store(Conference $conference): void
    {
        $this->getEntityManager()->persist($conference);
        $this->getEntityManager()->flush();
    }
    
    public function get(Uuid $uuid): ?Conference
    {
        return $this->find($uuid);
    }
}