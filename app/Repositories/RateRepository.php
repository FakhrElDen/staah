<?php

namespace App\Repositories;

use App\Models\Rate;

class RateRepository
{
    public function findOrCreate(array $data, int $roomId)
    {
        return Rate::updateOrCreate(
            ['rate_id' => $data['rate_id'], 'room_id' => $roomId],
            ['currency' => $data['currency'] ?? null]
        );
    }
}
