<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushDataItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'push_data_id',
        'from_date',
        'to_date',
        'inventory',
        'min_stay',
        'max_stay',
        'min_stay_through',
        'max_stay_through',
        'cta',
        'ctd',
        'stop_sell',
        'amount_before_tax',
        'amount_after_tax',
    ];

    protected $casts = [
        'amount_before_tax' => 'array',
        'amount_after_tax'  => 'array',
        'from_date'         => 'date',
        'to_date'           => 'date',
    ];

    public function pushData()
    {
        return $this->belongsTo(PushData::class);
    }
}
