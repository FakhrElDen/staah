<?php

namespace App\Repositories;

use App\Models\PushData;

class PushDataRepository
{
    public function create(array $data, int $propertyId, int $roomId, int $rateId)
    {
        
        return PushData::create([
            'property_id' => $propertyId,
            'room_id'     => $roomId,
            'rate_id'     => $rateId,
            'currency'    => $data['currency'] ?? null,
            'tracking_id' => $data['trackingId'] ?? null,
            'version'     => $data['version'],
        ]);
    }
}
