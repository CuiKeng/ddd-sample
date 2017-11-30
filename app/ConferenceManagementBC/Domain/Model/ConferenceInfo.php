<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Domain\Model;

use App\Common\IValueObject;

class ConferenceInfo implements IValueObject
{
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
    
    public function __construct(string $slug, string $name, string $description, string $location, string $tagline, \DateTime $startDate, \DateTime $endDate)
    {
        $this->slug = $slug;
        $this->name = $name;
        $this->description = $description;
        $this->location = $location;
        $this->tagline = $tagline;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    
    public function getSlug(): string
    {
        return $this->slug;
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
    
    public function getTagline(): string
    {
        return $this->tagline;
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