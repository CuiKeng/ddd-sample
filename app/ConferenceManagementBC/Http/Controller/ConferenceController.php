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
        $command = app()->make(CreateConferenceCommand::class, [
            'uuid' => Uuid::uuid4(),
            'ownerName' => 'LiLei',
            'ownerEmail' => 'LiLei@163.com',
            'slug' => 'This is slug',
            'name' => 'This is name',
            'description' => 'This is description',
            'location' => 'This is location',
            'tagline' => 'This is tagline',
            'startDate' => new \DateTime(),
            'endDate' => new \DateTime()
        ]);

        $this->commandDispatcher->dispatch($command);
    }
}