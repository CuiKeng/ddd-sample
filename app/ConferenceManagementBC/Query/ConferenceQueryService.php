<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Query;

use App\ConferenceManagementBC\Query\DTO\ConferenceDTO;

class ConferenceQueryService
{
    public function findConferenceById(string $id): ?ConferenceDTO
    {
        $data = app('db')->table('conference')->where('id', $id)->first();
        if (empty($data)) {
            return null;
        }
        
        return app()->make(ConferenceDTO::class, [
            'id' => $data->id,
            'ownerName' => $data->owner_name,
            'ownerEmail' => $data->owner_email,
            'name' => $data->name,
            'description' => $data->description,
            'location' => $data->location,
            'startDate' => \DateTime::createFromFormat('Y-m-d H:i:s', $data->start_date),
            'endDate' => \DateTime::createFromFormat('Y-m-d H:i:s', $data->end_date)
        ]);
    }
}