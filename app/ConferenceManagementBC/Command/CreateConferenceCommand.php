<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Command;

use Ramsey\Uuid\Uuid;

class CreateConferenceCommand
{
    /**
     * @var Uuid
     */
    private $uuid;
    
    /**
     * @var string
     */
    private $ownerName;
    
    /**
     * @var string
     */
    private $ownerEmail;
    
    /**
     * @var string
     */
    private $slug;
    
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
     * @var string
     */
    private $tagline;
    
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
        string $ownerName,
        string $ownerEmail,
        string $slug,
        string $name, 
        string $description,
        string $location,
        string $tagline,
        \DateTime $startDate,
        \DateTime $endDate
    ) {
        $this->uuid = $uuid;
        $this->ownerName = $ownerName;
        $this->ownerEmail = $ownerEmail;
        $this->slug = $slug;
        $this->name = $name;
        $this->description = $description;
        $this->location = $location;
        $this->tagline = $tagline;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    
    public function __get($key)
    {
        return $this->$key;
    }
}