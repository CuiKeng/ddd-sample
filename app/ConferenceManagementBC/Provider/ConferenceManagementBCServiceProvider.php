<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Provider;

use Illuminate\Support\ServiceProvider;
use App\Core\EventBus\IEventDispatcher;
use App\Core\CommandBus\ICommandDispatcher;
use App\ConferenceManagementBC\Domain\Repository\IConferenceRepository;
use App\ConferenceManagementBC\Repository\Doctrine\ConferenceRepository;
use App\ConferenceManagementBC\Domain\Factory\IConferenceFactory;
use App\ConferenceManagementBC\Factory\ConferenceFactory;
use App\ConferenceManagementBC\Command\CreateConferenceCommand;
use App\ConferenceManagementBC\CommandHandler\CreateConferenceCommandHandler;
use App\ConferenceManagementBC\MessagePublisher\ConferenceMessagePublisher;
use App\ConferenceManagementBC\Domain\Model\Conference;
use Doctrine\ORM\EntityManagerInterface;

class ConferenceManagementBCServiceProvider extends ServiceProvider
{
    public function register(): void
    {         
        $this->app->singleton(IConferenceFactory::class, ConferenceFactory::class);
//         $this->app->singleton(IConferenceRepository::class, ConferenceRepository::class);
        $this->app->singleton(IConferenceRepository::class, function ($app) {
            return $app->make(EntityManagerInterface::class)->getRepository(Conference::class);
        });
    }
    
    public function boot(ICommandDispatcher $commandDispatcher, IEventDispatcher $eventDispatcher): void
    {
        $commandDispatcher->map([
            CreateConferenceCommand::class => CreateConferenceCommandHandler::class 
        ]);
        
        $eventDispatcher->subscribe(ConferenceMessagePublisher::class);
    }
}