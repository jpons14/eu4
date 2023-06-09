<?php

namespace App\Console\Commands;

use App\Jobs\CloseMoves;
use App\Jobs\MakeSSVisible;
use App\Jobs\ProcessPodcast;
use App\Models\Move;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CloseMovesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'moves:close';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'If there is any move that the `will_be_finished_at` is in the past will be closed and the ship will be moved to the destination';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

//        CloseMoves::dispatch();
        \Log::debug('close moves command');
        MakeSSVisible::dispatch();


        return 0;
    }


}
