<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Domain\Model;

use App\Core\Domain\AggregateRoot;
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
    
    public function __construct(Uuid $uuid, ConferenceInfo $conferenceInfo, ConferenceOwner $conferenceOwner)
    {
        parent::__construct();
        
        $this->applyEvent(app()->make(ConferenceCreated::class, [
            'uuid' => $uuid,
            'conferenceInfo' => $conferenceInfo,
            'conferenceOwner' => $conferenceOwner
        ]));
    }
    
    public function getUuid(): Uuid
    {
        return $this->uuid;
    }
    
    public function getConferenceInfo(): ConferenceInfo
    {
        return $this->conferenceInfo;
    }
    
    public function getConferenceOwner(): ConferenceOwner
    {
        return $this->conferenceOwner;
    }
    
    protected function handleConferenceCreated(ConferenceCreated $event): void
    {
        $this->uuid = $event->getUuid();
        $this->conferenceInfo = $event->getConferenceInfo();
        $this->conferenceOwner = $event->getConferenceOwner();
        $this->seatTypes = Collection::make([]);
    }
}