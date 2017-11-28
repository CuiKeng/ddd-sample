<?php

declare(strict_types=1);

namespace App\CargoBC\CommandHandler;

use App\CargoBC\Command\CreateCargoCommand;
use App\CargoBC\Domain\Cargo;
use App\CargoBC\Domain\ICargoRepository;
use App\CargoBC\Domain\TrackingId;

class CreateCargoCommandHandler
{
    /**
     * @var ICargoRepository
     */
    private $cargoRepository;
    
    public function __construct(ICargoRepository $cargoRepository)
    {
        $this->cargoRepository = $cargoRepository;
    }
    
    public function handle(CreateCargoCommand $command): void
    {
        $trackingId = new TrackingId($command->getUuid());
        $cargo = new Cargo($trackingId);
        
        $this->cargoRepository->store($cargo);
    }
}