<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\CommandHandler;

use App\ConferenceManagementBC\Command\CreateConferenceCommand;
use App\ConferenceManagementBC\Domain\Repository\IConferenceRepository;
use App\ConferenceManagementBC\Domain\Factory\IConferenceFactory;
use Ramsey\Uuid\Uuid;

class CreateConferenceCommandHandler
{
    /**
     * @var IConferenceFactory
     */
    private $conferenceFactory;
    
    /**
     * @var IConferenceRepository
     */
    private $conferenceRepository;
    
    public function __construct(IConferenceFactory $conferenceFactory, IConferenceRepository $conferenceRepository)
    {
        $this->conferenceFactory = $conferenceFactory;
        $this->conferenceRepository = $conferenceRepository;
    }
    
    public function handle(CreateConferenceCommand $command): void
    {
        $conference = $this->conferenceFactory->createConference(
            $command->uuid,
            $command->ownerName,
            $command->ownerEmail,
            $command->name,
            $command->description,
            $command->location,
            $command->startDate,
            $command->endDate
        );
        $this->conferenceRepository->store($conference);
//         $conference = $this->conferenceRepository->get(Uuid::fromString('be4c6282-9187-4579-8a54-e56e44e61c77'));
        
//         var_dump($this->conferenceRepository->get($command->uuid));
    }
}