<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\CommandHandler;

use App\ConferenceManagementBC\Domain\Factory\IConferenceFactory;
use App\ConferenceManagementBC\Domain\Repository\IConferenceRepository;
use App\ConferenceManagementBC\Command\UpdateConferenceCommand;

class UpdateConferenceCommandHandler
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
    
    public function handle(UpdateConferenceCommand $command): void
    {
        
    }
}