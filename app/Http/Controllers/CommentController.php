<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\EventRequest;
use App\Http\Controllers\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;


class CommentController extends Controller
{
    public function save(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
            'tentative_date' => 'required',
            'handover_date' =>'required',
            'rating' => 'required',
            'comment_text' => 'required',
            'feedback_text' => 'required',
            'files' => 'mimes:jpeg,jpg,png,pdf,doc,docx|max:2048',
        ]);

        if(session('userType') == 'resolver' &&  ($request->status == 'Open' || $request->status == 'WIP' || $request->status == 'On Hold' ||$request->status == 'Information Awaiting' || $request->status == 'Feedback Awaiting')){
            $event = EventRequest::find(Crypt::decrypt($id));
            $event->status = $request->status;
            if($request->status != 'Feedback Awaiting'){
                $event->tentative_date = isset($request->tentative_date) ? $request->tentative_date :'NULL';
            }
            if($request->status == 'Feedback Awaiting'){
                $event->handover_date = $request->handover_date ? $request->handover_date :'';
            }
            
            $event->update();
        }elseif(session('userType') == 'requester' &&  $request->status == 'Closed'){
            $event = EventRequest::find(Crypt::decrypt($id));
            $event->status = $request->status;
            $event->rating = $request->rating ? $request->rating :'';
            $event->feedback = $request->feedback_text ? $request->feedback_text :'';
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
