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
        string $slug,
        string $name,
        string $description,
        string $location,
        string $tagline,
        \DateTime $startDate,
        \DateTime $endDate
    ) {
        $conferenceInfo = app()->make(ConferenceInfo::class, [
            'slug' => $slug,
            'name' => $name,
            'description' => $description,
            'location' => $location,
            'tagline' => $tagline,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
        $conferenceOwner = app()->make(ConferenceOwner::class, [
            'name' => $ownerName,
            'email' => $ownerEmail
        ]);
        $conference = app()->make(Conference::class, [
            'uuid' => $uuid,
            'conferenceInfo' => $conferenceInfo,
            'conferenceOwner' => $conferenceOwner
        ]);
        
        return $conference;
    }
}