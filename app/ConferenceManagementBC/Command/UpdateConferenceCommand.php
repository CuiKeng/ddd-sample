<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Command;

class UpdateConferenceCommand
{
    /**
     * @var Uuid
     */
    private $uuid;
    
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
    
    public function __construct(
        Uuid $uuid,
        string $name,
        string $description,
        string $location,
        \DateTime $startDate,
        \DateTime $endDate
    ) {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->description = $description;
        $this->location = $location;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    
    public function __get($key)
    {
        return $this->$key;
    }
}