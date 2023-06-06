<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolarSystem extends Model
{
    use HasFactory;


    public function galaxy()
    {
        return $this->belongsTo(Galaxy::class, 'GalaxyID');
    }

    public function planets()
    {
        return $this->hasMany(Planet::class, 'SolarSystemID');
    }
}
