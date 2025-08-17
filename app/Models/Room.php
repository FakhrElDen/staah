<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'room_id',
        'name',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function pushData()
    {
        return $this->hasMany(PushData::class);
    }
}
