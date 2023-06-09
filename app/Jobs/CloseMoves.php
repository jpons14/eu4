<?php

namespace App\Jobs;

use App\Models\Move;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CloseMoves implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        User::find(1)->moves->where('has_arrived', 0)->each(function(Move $move){
            \Log::info($move);
            if($this->hasMoveFinished($move)){
                $move->update([
                    'has_arrived' => 1,
                    'will_be_finished_at' => null
                ]);
                $tmp = $move->ship->update([
                    'SolarSystemX' => $move->SolarSystemX,
                    'SolarSystemY' => $move->SolarSystemY,
                    'GalaxyX' => $move->GalaxyX,
                    'GalaxyY' => $move->GalaxyY,
                ]);
            }
        });
    }

    public function hasMoveFinished(Move $move)
    {
        return Carbon::now()->diffInSeconds($move->will_be_finished_at, false) < 0;
    }
}
