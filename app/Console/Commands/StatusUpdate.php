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
        $currentdate =  Carbon::now()->format('Y-m-d');
        $allevents = EventRequest::where('status','Feedback Awaiting')->get();
        foreach ($allevents as $event){
            $eventdate = Carbon::parse($event->handover_date);
            $date = $eventdate->diffInDays($currentdate);
            if($date > 0){
                EventRequest::where('id',$event->id)->update(['status' => 'Closed']);
            }
        }
        $this->info('Successfully run to cron job scheduler');
    }
}
