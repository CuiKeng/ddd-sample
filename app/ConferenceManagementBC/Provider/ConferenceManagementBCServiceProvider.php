<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Provider;

use Illuminate\Support\ServiceProvider;
use App\Common\IEventDispatcher;
use App\Common\ICommandDispatcher;
use App\ConferenceManagementBC\Domain\Repository\IConferenceRepository;
use App\ConferenceManagementBC\Repository\InMemory\ConferenceRepository;
use App\ConferenceManagementBC\Domain\Factory\IConferenceFactory;
use App\ConferenceManagementBC\Factory\ConferenceFactory;
use App\ConferenceManagementBC\Command\CreateConferenceCommand;
use App\ConferenceManagementBC\CommandHandler\CreateConferenceCommandHandler;
use App\ConferenceManagementBC\MessagePublisher\ConferenceMessagePublisher;

class ConferenceManagementBCServiceProvider extends ServiceProvider
{
    public function register(): void
    {        
        $this->app->singleton(IConferenceRepository::class, ConferenceRepository::class);
        $this->app->singleton(IConferenceFactory::class, ConferenceFactory::class);
    }
    
    public function boot(ICommandDispatcher $commandDispatcher, IEventDispatcher $eventDispatcher): void
    {
        $commandDispatcher->map([
            CreateConferenceCommand::class => CreateConferenceCommandHandler::class 
        ]);
        
        $eventDispatcher->subscribe(ConferenceMessagePublisher::class);
    }
}