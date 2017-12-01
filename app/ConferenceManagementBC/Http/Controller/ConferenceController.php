<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Http\Controller;

use App\ConferenceManagementBC\Domain\Repository\IConferenceRepository;
use App\Common\ICommandDispatcher;
use App\ConferenceManagementBC\Command\CreateConferenceCommand;
use Ramsey\Uuid\Uuid;

class ConferenceController extends Controller
{
    /**
     * @var ICommandDispatcher
     */
    private $commandDispatcher;
    
    /**
     * @var IConferenceRepository
     */
    private $conferenceRepository;
    
    public function __construct(ICommandDispatcher $commandDispatcher, IConferenceRepository $conferenceRepository)
    {
        $this->commandDispatcher = $commandDispatcher;
        $this->conferenceRepository = $conferenceRepository;
    }
    
    public function create()
    {
        $command = new CreateConferenceCommand(
            Uuid::uuid4(), 
            'LiLei',
            'LiLei@163.com',
            'This is name',
            'This is description',
            'This is location',
            \DateTime::createFromFormat('Y-m-d H:i', '2017-11-30 12:00'),
            \DateTime::createFromFormat('Y-m-d H:i', '2017-11-30 12:00')
        );

        $this->commandDispatcher->dispatch($command);
    }
    
    public function update()
    {
        
    }
}