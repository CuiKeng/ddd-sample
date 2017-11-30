<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Domain\Model;

use App\Common\IEntity;

class SeatType implements IEntity
{
    /**
     * @var string
     */
    private $seatTypeId;
    
    /**
     * @var string
     */
    private $name;
    
    /**
     * @var string
     */
    private $description;
    
    /**
     * @var float
     */
    private $price;
    
    /**
     * @var int
     */
    private $quantity;
    
    public function __construct(string $seatTypeId, string $name, string $description, float $price, int $quantity)
    {
        $this->seatTypeId = $seatTypeId;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->quantity = $quantity;
    }
    
    public function getSeatTypeId(): string
    {
        return $this->seatTypeId;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function getDescription(): string
    {
        return $this->description;
    }
    
    public function getPrice(): string
    {
        return $this->price;
    }
    
    public function getQuantity(): string
    {
        return $this->quantity;
    }
}