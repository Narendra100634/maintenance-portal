<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EventRequest;
use App\Models\User;
use App\Models\RequestType;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Log;

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
        $currentdate =  Carbon::now()->format('Y-m-d H:i:s');
       $allevents = EventRequest::where('status','Feedback Awaiting')->where('handover_date', '<=', Carbon::now()->subDays(2)->toDateTimeString())->get();
        
        foreach ($allevents as $event){
       
            $autoevent = EventRequest::find($event->id);
            $autoevent->closer_date = $currentdate;
            $autoevent->status = 'Closed';
            $autoevent->feedback = '<p>Auto Closure.</p>';
            $autoevent->update();
        
            $id = $event->resv_id;
            $resolverData = User::where('id','=',$event->resv_id)->first();
            $reqType = RequestType::find($event->request_type);
            //$adminEmail = User::where('user_type', 1)->first();
            if($event->req_region == 'KTC' || $event->req_region =='KRO'){
                $adminEmail = User::where('user_type', 1)->where('location', '=', $event->req_region)->first();
            }else{
                $adminEmail = User::where('user_type', 1)->first();
            }
            
            if(isset($event)){
                Log::info(['request id'=>$autoevent->id ]);

                Mail::send('EmailTemplats.autocloserequest', [
                    'requestid'            => $event->id,
                    'status'               => $autoevent->status,
                    'tentative_date'       => $event->tentative_date,
                    'handover_date'        => $event->handover_date,
                    'closer_date'          => $autoevent->closer_date,
                    'feedback'             => $autoevent->feedback,
                    'requestdate'          => $event->created_at,
                    'priority'             => $event->priority,
                    'requestType'          => $reqType->name,
                    'subject'              => $event->subject,
                    'resolverName'         => $resolverData->name,
                    'requesterName'        => $event->req_name,
                ],
                function ($message) use($resolverData, $event, $adminEmail){
                        $emailFrom = 'karamalert@karamportals.com';
                        $emlTo  =  $resolverData->email;                 
                        $message->from($emailFrom);
                        $message->to($emlTo, 'Your Name')
                        ->cc([$event->req_email])
                        ->cc([$adminEmail->email])
                        ->subject('[KARAM - Maintenance] Service request ticket response received Ticket ID #'.$event->id);
                    }
                );
            } 

            
        }
        $this->info('Successfully run to cron job scheduler');
    }
}
