<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Repository\Eloquent;

use App\ConferenceManagementBC\Domain\Repository\IConferenceRepository;
use App\Core\EventBus\IEventDispatcher;
use App\ConferenceManagementBC\Domain\Model\Conference;
use Ramsey\Uuid\Uuid;
use App\ConferenceManagementBC\Domain\Model\ConferenceInfo;
use App\ConferenceManagementBC\Domain\Model\ConferenceOwner;

class ConferenceRepository implements IConferenceRepository
{
    /**
     * @var IEventDispatcher
     */
    private $eventDispatcher;
    
    private $db;
    
    public function __construct(IEventDispatcher $eventDispatcher)
    {
        $this->db = app()->make('db');
        $this->eventDispatcher = $eventDispatcher;
    }
    
    public function store(Conference $conference): void
    {
        $this->db->table('conference')->insert([
            'id' => $conference->getUuid()->toString(),
            'owner_name' => $conference->getConferenceOwner()->getName(),
            'owner_email' => $conference->getConferenceOwner()->getEmail(),
            'name' => $conference->getConferenceInfo()->getName(),
            'description' => $conference->getConferenceInfo()->getDescription(),
            'location' => $conference->getConferenceInfo()->getLocation(),
            'start_time' => $conference->getConferenceInfo()->getStartDate()->format('Y-m-d H:i:s'),
            'end_time' => $conference->getConferenceInfo()->getEndDate()->format('Y-m-d H:i:s')
        ]);
        
        $conference->getUncommittedEvents()->each(function ($item, $key) {
            $this->eventDispatcher->fire($item);
        });
    }
    
    public function get(Uuid $uuid): ?Conference
    {
        $data = $this->db->table('conference')->where('id', $uuid->toString())->first();
        
        $conferenceOwnerRefl = new \ReflectionClass(ConferenceOwner::class);
        $conferenceOwner = $conferenceOwnerRefl->newInstanceWithoutConstructor();
        $conferenceOwnerPropertyMapping = [
            'name' => 'owner_name',
            'email' => 'owner_email'
        ];
        foreach ($conferenceOwnerPropertyMapping as $property => $field) {
            $propertyRefl = new \ReflectionProperty(ConferenceOwner::class, $property);
            $propertyRefl->setAccessible(true);
            $propertyRefl->setValue($conferenceOwner, $data->$field);
        }
        
        $conferenceInfoRefl = new \ReflectionClass(ConferenceInfo::class);
        $conferenceInfo = $conferenceInfoRefl->newInstanceWithoutConstructor();
        $conferenceInfoPropertyMapping = [
            'name' => 'name',
            'description' => 'description',
            'location' => 'location',
            'startDate' => 'start_time',
            'endDate' => 'end_time'
        ];
        foreach ($conferenceInfoPropertyMapping as $property => $field) {
            $propertyRefl = new \ReflectionProperty(ConferenceInfo::class, $property);
            $propertyRefl->setAccessible(true);
            $propertyRefl->setValue($conferenceInfo, $data->$field);
        }
        
        $uuid = Uuid::fromString($data->id);
        
        $conferenceRefl = new \ReflectionClass(Conference::class);
        $conference = $conferenceRefl->newInstanceWithoutConstructor();
        $uuidPropertyRefl = new \ReflectionProperty(Conference::class, 'uuid');
        $uuidPropertyRefl->setAccessible(true);
        $uuidPropertyRefl->setValue($conference, $uuid);
        $conferenceInfoPropertyRefl = new \ReflectionProperty(Conference::class, 'conferenceInfo');
        $conferenceInfoPropertyRefl->setAccessible(true);
        $conferenceInfoPropertyRefl->setValue($conference, $conferenceInfo);
        $conferenceOwnerPropertyRefl = new \ReflectionProperty(Conference::class, 'conferenceOwner');
        $conferenceOwnerPropertyRefl->setAccessible(true);
        $conferenceOwnerPropertyRefl->setValue($conference, $conferenceOwner);
        
        return $conference;
    }
}