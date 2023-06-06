<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanetsResource extends Model
{
    use HasFactory;

    public function planet()
    {
        return $this->belongsTo(Planet::class, 'PlanetID');
    }

    public function resource_type()
    {
        return $this->belongsTo(ResourcesType::class, 'ResourceTypeID');
    }
}
