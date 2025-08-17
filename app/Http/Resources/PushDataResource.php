<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PushDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'propertyid' => $this->property?->property_id,
            'room_id'    => $this->room?->room_id,
            'rate_id'    => $this->rate?->rate_id,
            'currency'   => $this->currency,
            'apikey'     => $this->property?->api_key,
            'data'       => PushDataItemResource::collection($this->items),
            'trackingId' => $this->tracking_id,
            'version'    => $this->version,
        ];
    }
}
