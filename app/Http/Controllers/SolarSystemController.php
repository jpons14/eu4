<?php

namespace App\Http\Controllers;

use App\Events\CheckFinishedMoves;
use App\Models\User;
use Illuminate\Http\Request;

class SolarSystemController extends Controller
{
    public function getVisibleSS(User $user)
    {
//        event(new CheckFinishedMoves($user));
        return $user->ssVisible;
    }
}
