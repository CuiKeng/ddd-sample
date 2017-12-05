<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Http\Controller;

use App\Core\CommandBus\ICommandDispatcher;
use App\ConferenceManagementBC\Command\CreateConferenceCommand;
use Ramsey\Uuid\Uuid;
use App\ConferenceManagementBC\Query\ConferenceQueryService;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ConferenceController extends Controller
{
    /**
     * @var ICommandDispatcher
     */
    private $commandDispatcher;
    
    /**
     * @var ConferenceQueryService
     */
    private $conferenceQueryService;
    
    public function __construct(ICommandDispatcher $commandDispatcher, ConferenceQueryService $conferenceQueryService)
    {
        $this->commandDispatcher = $commandDispatcher;
        $this->conferenceQueryService = $conferenceQueryService;
    }
    
    public function create(): void
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
    
    public function update(string $id): void
    {
        
    }
    
    public function delete(string $id): void
    {
        
    }
    
    public function view(string $id): array
    {
        $conference = $this->conferenceQueryService->findConferenceById($id);
        if (is_null($conference)) {
            throw new HttpException(404);
        }
        
        return $conference->toArray();
    }
    
    public function index(): void
    {
        
    }
}