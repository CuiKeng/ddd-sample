<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Query\DTO;

class ConferenceDTO
{
    /**
     * @var string
     */
    private $id;
    
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
        string $id,
        string $ownerName,
        string $ownerEmail,
        string $name,
        string $description,
        string $location,
        \DateTime $startDate,
        \DateTime $endDate
    ) {
        $this->id = $id;
        $this->ownerName = $ownerName;
        $this->ownerEmail = $ownerEmail;
        $this->name = $name;
        $this->description = $description;
        $this->location = $location;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'owner_name' => $this->ownerName,
            'owner_email' => $this->ownerEmail,
            'name' => $this->name,
            'description' => $this->description,
            'location' => $this->location,
            'start_date' => $this->startDate->format('Y-m-d H:i'),
            'end_date' => $this->endDate->format('Y-m-d H:i')
        ];
    }
}