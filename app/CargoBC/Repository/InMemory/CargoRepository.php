<?php

declare(strict_types=1);

namespace App\CargoBC\Repository\InMemory;

use App\CargoBC\Domain\Cargo;
use App\CargoBC\Domain\ICargoRepository;
use Illuminate\Support\Collection;
use App\CargoBC\Domain\TrackingId;
use Illuminate\Contracts\Events\Dispatcher;

class CargoRepository implements ICargoRepository
{
    /**
     * @var Dispatcher
     */
    private $eventDispatcher;
    
    /**
     * @var Collection
     */
    private $list;
    
    public function __construct(Dispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->list = Collection::make([]);
    }
    
    public function store(Cargo $cargo): void
    {
        $this->list[$cargo->getTrackingId()->toString()] = $cargo;

        $cargo->getUncommittedEvents()->each(function ($item, $key) {
            $this->eventDispatcher->fire($item);
        });
    }
    
    public function get(TrackingId $trackingId): Cargo
    {
        return $this->list->get($trackingId->toString());
    }
}