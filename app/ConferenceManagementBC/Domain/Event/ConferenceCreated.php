<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Domain\Event;

use App\ConferenceManagementBC\Domain\Model\ConferenceInfo;
use App\ConferenceManagementBC\Domain\Model\ConferenceOwner;
use App\Common\IEvent;
use Ramsey\Uuid\Uuid;

class ConferenceCreated implements IEvent
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
    
    public function __construct(Uuid $uuid, ConferenceInfo $conferenceInfo, ConferenceOwner $conferenceOwner)
    {
        $this->uuid = $uuid;
        $this->conferenceInfo = $conferenceInfo;
        $this->conferenceOwner = $conferenceOwner;
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
}