<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\EventRequest;
use App\Http\Controllers\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

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
            $event->feedback = isset($request->feedback_text) ? $request->feedback_text :'';
            $event->update();
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
        }       
        return redirect()->route('req.allrequest')->with('success','Event Requst Updated Successfully');
    }
}
