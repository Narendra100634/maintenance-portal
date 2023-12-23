<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EventRequest;
use Illuminate\Support\Carbon;

class StatusUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:statusupdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ticket Update Status Auto Close';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
    }
}
