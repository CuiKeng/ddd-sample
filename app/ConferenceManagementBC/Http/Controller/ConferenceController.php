<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Http\Controller;

use App\ConferenceManagementBC\Domain\Repository\IConferenceRepository;
use App\Core\CommandBus\ICommandDispatcher;
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
        $refClass = new \ReflectionClass(Car::class);
        
        $car = $refClass->newInstanceWithoutConstructor();
        
        $wheel = new \ReflectionProperty($car, 'wheel');
        $wheel->setAccessible(true);
        $wheel->setValue($car, 'aaa');
        
        
        var_dump($car->getWheel());
    }
}

class Car
{
    private $wheel;
    
    public function __construct(string $wheel)
    {
        $this->wheel = $wheel;
    }
    
    public function getWheel()
    {
        return $this->wheel;
    }
}

class Wheel
{
    private $name;
    
    public function __construct(string $name)
    {
        $this->name = $name;
    }
}

