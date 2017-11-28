<?php

declare(strict_types=1);

namespace App\CargoBC\Provider;

use Illuminate\Support\ServiceProvider;
use App\CargoBC\Domain\ICargoRepository;
use App\CargoBC\Repository\InMemory\CargoRepository;
use Illuminate\Contracts\Bus\Dispatcher;

class CargoBCServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ICargoRepository::class, CargoRepository::class);
    }
    
    public function boot(Dispatcher $commandDispatcher): void
    {
        $commandDispatcher->map([
            'App\CargoBC\Command\CreateCargoCommand' => 'App\CargoBC\CommandHandler\CreateCargoCommandHandler'
        ]);
    }
}