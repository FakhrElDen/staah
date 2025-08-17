<?php

namespace App\Repositories;

use App\Models\Room;

class RoomRepository
{
    public function findOrCreate(array $data, int $propertyId)
    {
        return Room::updateOrCreate(
            ['room_id' => $data['room_id'], 'property_id' => $propertyId],
            []
        );
    }
}
