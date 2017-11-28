<?php

declare(strict_types=1);

namespace App\CargoBC\Http\Controller;

use App\CargoBC\Command\CreateCargoCommand;
use Ramsey\Uuid\Uuid;
use Illuminate\Contracts\Bus\Dispatcher;
use App\CargoBC\Query\CargoQuery;

class CargoController extends Controller
{
    private $commandDispatcher;
    private $cargoQuery;
    
    public function __construct(Dispatcher $commandDispatcher, CargoQuery $cargoQuery)
    {
        $this->commandDispatcher = $commandDispatcher;
        $this->cargoQuery = $cargoQuery;
    }
    
    public function create(): void
    {
        $uuid = Uuid::uuid4();
        
        $this->commandDispatcher->dispatch(new CreateCargoCommand($uuid));
    }
    
    public function get(string $uuid): array
    {
        $cargoDto = $this->cargoQuery->getCargo($uuid);
        
        return $cargoDto->toArray();
    }
}