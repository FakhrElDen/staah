<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushData extends Model
{
    use HasFactory;

    protected $table = 'push_data';

    protected $fillable = [
        'property_id',
        'room_id',
        'rate_id',
        'tracking_id',
        'version',
        'currency'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function rate()
    {
        return $this->belongsTo(Rate::class);
    }

    public function items()
    {
        return $this->hasMany(PushDataItem::class);
    }
}
