<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Provider;

use Illuminate\Support\ServiceProvider;
use App\Common\IEventDispatcher;
use App\Common\ICommandDispatcher;
use App\ConferenceManagementBC\Domain\Repository\IConferenceRepository;
use App\ConferenceManagementBC\Repository\Doctrine\ConferenceRepository;
use App\ConferenceManagementBC\Domain\Factory\IConferenceFactory;
use App\ConferenceManagementBC\Factory\ConferenceFactory;
use App\ConferenceManagementBC\Command\CreateConferenceCommand;
use App\ConferenceManagementBC\CommandHandler\CreateConferenceCommandHandler;
use App\ConferenceManagementBC\MessagePublisher\ConferenceMessagePublisher;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\DBAL\Types\Type;
use App\ConferenceManagementBC\Repository\Doctrine\Type\UuidType;
use App\ConferenceManagementBC\Domain\Model\Conference;

class ConferenceManagementBCServiceProvider extends ServiceProvider
{
    public function register(): void
    {         
        $this->app->singleton(IConferenceFactory::class, ConferenceFactory::class);
        $this->app->singleton('doctrine', function ($app) {
            return EntityManager::create([
                'driver' => 'pdo_mysql',
                'user' => 'root',
                'password' => '',
                'dbname' => 'ddd-sample',
                'charset' => 'utf8'
            ], Setup::createXMLMetadataConfiguration([
                app()->path() . '/ConferenceManagementBC/Repository/Doctrine/Mapping'
            ]));
        });
//         $this->app->singleton(IConferenceRepository::class, ConferenceRepository::class);
        $this->app->singleton(IConferenceRepository::class, function ($app) {
            return $app->make('doctrine')->getRepository(Conference::class);
        });
    }
    
    public function boot(ICommandDispatcher $commandDispatcher, IEventDispatcher $eventDispatcher): void
    {
        $commandDispatcher->map([
            CreateConferenceCommand::class => CreateConferenceCommandHandler::class 
        ]);
        
        $eventDispatcher->subscribe(ConferenceMessagePublisher::class);
        
        if (! Type::hasType(UuidType::TYPE_NAME)) {
            Type::addType(UuidType::TYPE_NAME, UuidType::class);
        }
    }
}