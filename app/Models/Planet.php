<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    use HasFactory;

    public function solar_system()
    {
        return $this->belongsTo(SolarSystem::class, 'SolarSystemID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function factories()
    {
        return $this->hasMany(Factory::class, 'PlanetID');
    }
}
