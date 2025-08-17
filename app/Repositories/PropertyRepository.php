<?php

namespace App\Repositories;

use App\Models\Property;

class PropertyRepository
{
    public function findOrCreate(array $data)
    {
        return Property::updateOrCreate(
            ['property_id' => $data['propertyid']],
            ['api_key' => $data['apikey']]
        );
    }
}
