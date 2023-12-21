<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestType;
use App\Models\Comment;
use App\Models\EventRequest;
use App\Http\Controllers\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function save(Request $request, $id)
    {   
        $this->validate($request, [
           'files' => 'mimes:jpeg,jpg,png,pdf,doc,docx|max:2048',
        ]);
        if(session('userType') == 'resolver' &&  ($request->status == 'Open' || $request->status == 'WIP' || $request->status == 'On Hold' ||$request->status == 'Information Awaiting' || $request->status == 'Feedback Awaiting')){
             
            $event = EventRequest::find(Crypt::decrypt($id));
            $event->status = $request->status;
            if($request->status != 'Feedback Awaiting'){
                $date = $request->tentative_date;
                $newDate = Carbon::createFromFormat('m/d/Y', $date)->format('Y-m-d');
                $event->tentative_date = $newDate ? $newDate :'NULL';
            }
            if($request->status == 'Feedback Awaiting'){
                $date1 = $request->handover_date;
                $newDate1 = Carbon::createFromFormat('m/d/Y', $date1)->format('Y-m-d');
                $event->handover_date = $newDate1 ? $newDate1 :'';
            }
            
            $event->update();
        }elseif(session('userType') == 'requester' &&  $request->status == 'Closed'){
           
            $event = EventRequest::find(Crypt::decrypt($id));
            $event->status = $request->status;
            $event->rating = isset($request->rating) ? $request->rating :'';
            $date2 = $request->closer_date;
            $newDate2 = Carbon::createFromFormat('m/d/Y', $date2)->format('Y-m-d');
            $event->closer_date = $newDate2 ? $newDate2 :'';
            //$event->closer_date = isset($request->closer_date) ? $request->closer_date :'';
            $event->feedback = isset($request->feedback_text) ? $request->feedback_text :'';
            $event->update();

            $resolverData = User::find($event->resv_id);

            Mail::send('EmailTemplats.closestatusrequest', [
                'requestid'            =>$event->id,
                'status'               => $event->status,
                'closer_date'          => $event->closer_date,
                'rating'               => $event->rating,
                'feedback'             => $event->feedback,
            ],
                function ($message) use($resolverData, $event){
                    $emailFrom = 'karamalert@karamportals.com';
                    $emlTo  =  $resolverData->email;                 
                    $message->from($emailFrom);
                    $message->to($emlTo, 'Your Name')
                     ->cc([$event->req_email])
                    ->subject('Update ticket has been Assigned to you');
                }
            ); 
        }   
        if($request->comment_text != null){

            if($request->hasfile('files')){ 
                $file = $request->file('files');
                $file_name =$file->getClientOriginalName();  
                $dataFile =  $file->move('file-data/comments',$file_name); 
            } 
            $comment = new Comment;        
            $comment->event_id = Crypt::decrypt($id);
            $comment->user_name = session('name');
            $comment->user_email = session('email');
            $comment->comment = $request->comment_text;
            $comment->attachment = isset($file_name) ? $file_name : '';
            $comment->save();
            $requestData = EventRequest::find(Crypt::decrypt($id));
            $resolverData = User::find($requestData->resv_id);
            //$adminemail ='admin@karam.in';
            if($requestData != null){   
               
                if($requestData->status == 'WIP'){
                
                    Mail::send('EmailTemplats.wipstatusrequest', [
                        'requestid'            =>$requestData->id,
                        'status'               => $requestData->status,
                        'tentative_date'       => $requestData->tentative_date,
                        'comment'              => $comment->comment,
                    ],
                        function ($message) use($resolverData, $requestData){
                            $emailFrom = 'karamalert@karamportals.com';
                            $emlTo  =  $resolverData->email;                   
                            $message->from($emailFrom);
                            $message->to($emlTo, 'Your Name')
                             ->cc([$requestData->req_email])
                            ->subject('Update ticket has been Assigned to you');
                        }
                    ); 
                }
                elseif($requestData->status == 'Information Awaiting'){
                
                    Mail::send('EmailTemplats.informationstatusrequest', [
                        'requestid'            =>$requestData->id,
                        'status'               => $requestData->status,
                        'tentative_date'       => $requestData->tentative_date,
                        'comment'              => $comment->comment,
                    ],
                        function ($message) use($resolverData, $requestData){
                            $emailFrom = 'karamalert@karamportals.com';
                            $emlTo  =  $resolverData->email;                   
                            $message->from($emailFrom);
                            $message->to($emlTo, 'Your Name')
                             ->cc([$requestData->req_email])
                            ->subject('Update ticket has been Assigned to you');
                        }
                    ); 
                }
                elseif($requestData->status == 'Feedback Awaiting'){
                
                    Mail::send('EmailTemplats.feedbackstatusrequest', [
                        'requestid'            =>$requestData->id,
                        'status'               => $requestData->status,
                        'handover_date'       => $requestData->handover_date,
                        'comment'              => $comment->comment,
                    ],
                        function ($message) use($resolverData, $requestData){
                            $emailFrom = 'karamalert@karamportals.com';
                            $emlTo  =  $resolverData->email;                   
                            $message->from($emailFrom);
                            $message->to($emlTo, 'Your Name')
                             ->cc([$requestData->req_email])
                            ->subject('Update ticket has been Assigned to you');
                        }
                    ); 
                }
                elseif($requestData->status == 'On Hold'){
                
                    Mail::send('EmailTemplats.onholdstatusrequest', [
                        'requestid'            =>$requestData->id,
                        'status'               => $requestData->status,
                        'tentative_date'       => $requestData->tentative_date,
                        'comment'              => $comment->comment,
                    ],
                        function ($message) use($resolverData, $requestData){
                            $emailFrom = 'karamalert@karamportals.com';
                            $emlTo  =  $resolverData->email;                   
                            $message->from($emailFrom);
                            $message->to($emlTo, 'Your Name')
                             ->cc([$requestData->req_email])
                            ->subject('Update ticket has been Assigned to you');
                        }
                    ); 
                }
                elseif($requestData->status == 'Closed'){
 
                }
            } 

        }       
        // return redirect()->route('req.allrequest')->with('success',' Requst Updated Successfully');
        return back()->with('success',' Requst Updated Successfully');
    }
}
