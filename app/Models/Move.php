<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    use HasFactory;



    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function ship()
    {
        return $this->belongsTo(Ship::class, 'ShipID');
    }
}
