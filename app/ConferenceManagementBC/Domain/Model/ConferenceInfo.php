<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Domain\Model;

use App\Common\IValueObject;

class ConferenceInfo implements IValueObject
{    
    /**
     * @var string
     */
    private $name;
    
    /**
     * @var string
     */
    private $description;
    
    /**
     * @var string
     */
    private $location;
    
    /**
     * @var \DateTime
     */
    private $startDate;
    
    /**
     * @var \DateTime
     */
    private $endDate;
    
    public function __construct(string $name, string $description, string $location, \DateTime $startDate, \DateTime $endDate)
    {
        $this->name = $name;
        $this->description = $description;
        $this->location = $location;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function getDescription(): string
    {
        return $this->description;
    }
    
    public function getLocation(): string
    {
        return $this->location;
    }
    
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }
    
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }
}