<?php

declare(strict_types=1);

namespace App\Core\Provider;

use Illuminate\Support\ServiceProvider;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use App\Core\CommandBus\ICommandDispatcher;
use App\Core\CommandBus\CommandDispatcher;
use App\Core\EventBus\IEventDispatcher;
use App\Core\EventBus\EventDispatcher;
use App\Core\MessageBus\IMessageDispatcher;
use App\Core\MessageBus\MessageDispatcher;
use Doctrine\DBAL\Types\Type;
use App\ConferenceManagementBC\Repository\Doctrine\Type\UuidType;
use Illuminate\Contracts\Queue\Factory as QueueFactoryContract;

class CoreServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerDoctrine();
        $this->registerCommandDispatcher();
        $this->registerEventDispatcher();
        $this->registerMessageDispatcher();
    }
    
    public function boot(): void
    {
        $this->bootDoctrineType();
    }
    
    protected function registerDoctrine(): void
    {
        $this->app->singleton(EntityManagerInterface::class, function ($app) {
            $config = $app->make('config');
            
            return EntityManager::create([
                'driver' => $config->get('doctrine.driver'),
                'user' => $config->get('doctrine.user'),
                'password' => $config->get('doctrine.password'),
                'dbname' => $config->get('doctrine.dbname'),
                'charset' => $config->get('doctrine.charset')
            ], Setup::createXMLMetadataConfiguration([
                $app->path() . '/ConferenceManagementBC/Repository/Doctrine/Mapping'
            ]));
        });
    }
    
    protected function registerCommandDispatcher(): void
    {
        $this->app->singleton(ICommandDispatcher::class, function ($app) {
            return new CommandDispatcher($app, function ($connection = null) use ($app) {
                return $app[QueueFactoryContract::class]->connection($connection);
            });
        });
    }
    
    protected function registerEventDispatcher(): void
    {
        $this->app->singleton(IEventDispatcher::class, function ($app) {
            return (new EventDispatcher($app))->setQueueResolver(function () use ($app) {
                return $app->make(QueueFactoryContract::class);
            });
        });
    }
    
    protected function registerMessageDispatcher(): void
    {
        $this->app->singleton(IMessageDispatcher::class, function ($app) {
            return (new MessageDispatcher($app))->setQueueResolver(function () use ($app) {
                return $app->make(QueueFactoryContract::class);
            });
        });
    }
    
    protected function bootDoctrineType(): void
    {
        if (! Type::hasType(UuidType::TYPE_NAME)) {
            Type::addType(UuidType::TYPE_NAME, UuidType::class);
        }
    }
}