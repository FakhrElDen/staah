<?php

namespace App\Repositories;

use App\Models\PushDataItem;
use Illuminate\Support\Carbon;

class PushDataItemRepository
{
    public function createMany(int $pushDataId, array $items)
    {
        foreach ($items as $item) {
            PushDataItem::create([
                'push_data_id'          => $pushDataId,
                'cta'                   => $item['cta'] ?? null,
                'ctd'                   => $item['ctd'] ?? null,
                'stop_sell'             => $item['stopsell'] ?? null,
                'min_stay'              => $item['minstay'] ?? null,
                'max_stay'              => $item['maxstay'] ?? null,
                'min_stay_through'      => $item['minstay_through'] ?? null,
                'max_stay_through'      => $item['maxstay_through'] ?? null,
                'inventory'             => $item['inventory'] ?? null,
                'from_date'             => Carbon::parse($item['from_date']) ?? null,
                'to_date'               => Carbon::parse($item['to_date']) ?? null,
                'amount_before_tax'     => $item['amountBeforeTax'] ?? null,
                'amount_after_tax'      => $item['amountAfterTax'] ?? null,
            ]);
        }
    }
}
