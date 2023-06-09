<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['UserID', 'ShipID', 'started_at', 'will_be_finished_at', 'has_arrived', 'GalaxyX', 'GalaxyY', 'SolarSystemX', 'SolarSystemY'];


    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function ship()
    {
        return $this->belongsTo(Ship::class, 'ShipID');
    }
}
