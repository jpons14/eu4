<?php

namespace App\Jobs;

use App\Models\SolarSystem;
use App\Models\SSVisible;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MakeSSVisible implements ShouldQueue
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
        $user = User::find(1);
        $user->moves->where('has_arrived', 1)->each(function ($move) use ($user){
            $ssID = SolarSystem::where('x', $move->ship->GalaxyX)->where('y', $move->ship->GalaxyY)->first()->id;
            $ssVisible = $this->getSSVisible($user);
            if (!$ssVisible->contains('SolarSystemID', $ssID)) {
                $this->addSSVisible($user, $ssID);
            }
        });
    }

    public function getSSVisible(User $user)
    {
        return $user->ssVisible;
    }

    public function addSSVisible(User $user, int $ssID)
    {

        SSVisible::create([
            'UserID' => $user->id,
            'SolarSystemID' => $ssID
        ]);
    }
}
