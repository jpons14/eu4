<?php

namespace App\Http\Controllers;

use App\Models\Planet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanetController extends Controller
{

    public function checkTimeBetweenNowAndLastCheck(Planet $planet)
    {
        return Carbon::now()->diffInSeconds($planet->last_time_checked);
    }

    public function addResources(Planet $planet)
    {
        $resourcesToAdd = $this->howManyResourcesToAdd($planet);

        foreach ($resourcesToAdd as $resourceType => $number) {
            $planet->$resourceType = $planet->$resourceType + $number;
        }
        $planet->last_time_checked = DB::raw('CURRENT_TIMESTAMP');

        return $planet->save();
    }

    public function howManyResourcesToAdd(Planet $planet)
    {
        $secondsPassed = Carbon::now()->diffInSeconds($planet->last_time_checked);
        $result = [];
        $factoriesTypes = [
            'titanium',
            'copper',
            'iron',
            'aluminium',
            'silicon',
            'uranium',
            'nitrogen',
            'hydrogen',
        ];

        // todo make it dynamic

        foreach ($factoriesTypes as $factoriesType) {
            $level =  $planet->factories->where('type', $factoriesType)->first()->level;
            $multiplierName = $factoriesType . '_multiplier';
            $percentage = $planet->$multiplierName;
            $howMuchToAdd =  $secondsPassed * floatval('0.' . $percentage) * $level;
            $result[$factoriesType] = $howMuchToAdd;
        }

        return $result;
    }

}
