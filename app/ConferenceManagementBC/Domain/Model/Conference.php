<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Domain\Model;

use App\Common\AggregateRoot;
use Illuminate\Support\Collection;
use App\ConferenceManagementBC\Domain\Event\ConferenceCreated;
use Ramsey\Uuid\Uuid;

class Conference extends AggregateRoot
{
    /**
     * @var Uuid
     */
    private $uuid;
    
    /**
     * @var ConferenceInfo
     */
    private $conferenceInfo;
    
    /**
     * @var ConferenceOwner
     */
    private $conferenceOwner;
    
    /**
     * @var Collection
     */
    private $seatTypes;
    
    /**
     * @var bool
     */
    private $isPublished;
    
    public function __construct(Uuid $uuid, ConferenceInfo $conferenceInfo, ConferenceOwner $conferenceOwner)
    {
        parent::__construct();
        
        $this->applyEvent(new ConferenceCreated($uuid, $conferenceInfo, $conferenceOwner));
    }
    
    protected function handleConferenceCreated(ConferenceCreated $event): void
    {
        $this->uuid = $event->getUuid();
        $this->conferenceInfo = $event->getConferenceInfo();
        $this->conferenceOwner = $event->getConferenceOwner();
        $this->seatTypes = Collection::make([]);
        $this->isPublished = false;
    }
}