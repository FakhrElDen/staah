<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'name',
        'api_key',
        'currency',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function pushData()
    {
        return $this->hasMany(PushData::class);
    }
}
