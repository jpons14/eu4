<?php

namespace App\Listeners;

use App\Events\AddResourcesEvent;
use App\Models\Planet;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class AddResourcesListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\AddResourcesEvent  $event
     * @return void
     */
    public function handle(AddResourcesEvent $event)
    {
        $planet = $event->planet;
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
