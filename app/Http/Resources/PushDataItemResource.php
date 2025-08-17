<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PushDataItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
     public function toArray(Request $request): array
    {
        return [
            'cta'              => $this->cta,
            'amountAfterTax'   => $this->amount_after_tax,
            'minstay'          => (int) $this->min_stay,
            'from_date'        => $this->from_date?->toDateString(),
            'to_date'          => $this->to_date?->toDateString(),
            'stopsell'         => $this->stop_sell,
            'amountBeforeTax'  => $this->amount_before_tax,
            'ctd'              => $this->ctd,
            'inventory'        => (int) $this->inventory,
            'maxstay'          => $this->max_stay,
            'minstay_through'  => $this->min_stay_through,
            'maxstay_through'  => $this->max_stay_through,
        ];
    }
}
