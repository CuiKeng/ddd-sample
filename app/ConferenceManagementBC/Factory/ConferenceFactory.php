<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Factory;

use App\ConferenceManagementBC\Domain\Factory\IConferenceFactory;
use App\ConferenceManagementBC\Domain\Model\ConferenceInfo;
use App\ConferenceManagementBC\Domain\Model\ConferenceOwner;
use App\ConferenceManagementBC\Domain\Model\Conference;
use Ramsey\Uuid\Uuid;

class ConferenceFactory implements IConferenceFactory
{
    public function createConference(
        Uuid $uuid,
        string $ownerName,
        string $ownerEmail,
        string $name,
        string $description,
        string $location,
        \DateTime $startDate,
        \DateTime $endDate
    ) {
        $conferenceInfo = new ConferenceInfo(
            $name,
            $description,
            $location,
            $startDate,
            $endDate
        );
        $conferenceOwner = new ConferenceOwner($ownerName, $ownerEmail);
        $conference = new Conference($uuid, $conferenceInfo, $conferenceOwner);
        
        return $conference;
    }
}