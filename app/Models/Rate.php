<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'rate_id',
        'name',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function pushData()
    {
        return $this->hasMany(PushData::class);
    }
}
