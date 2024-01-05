<?php

namespace App\Http\Controllers;

use App\Models\EventRequest;
use App\Models\RequestType;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
Use Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;

class EventRequestController extends Controller
{
    public function index()
    {   
        if(session('userType') != null || session('userType') != ''){  
            if(session('userType') == 'requester'){
                $resolverData = User::where('location', '=', session('region'))->get();
                $requests = RequestType::where('status', 1)->get();
                return view('request.create', compact('requests','resolverData'));
            }else{
                return Redirect::back();
            }
        }else{
            return redirect()->route('login');
        }
    }
    public function allrequest(Request $request, $name=null){

        if(session('userType') != null || session('userType') != ''){   
            if(session('userType') == 'requester'){
                if($name == 'active'){

                    $userEmail = session('email');
                    $resolverData = User::where('location', '=', session('region'))->get();
                    $datas = EventRequest::select('event_requests.id','event_requests.req_email','event_requests.req_name','event_requests.resv_id','event_requests.priority','event_requests.subject','event_requests.status','event_requests.description','event_requests.attachment','event_requests.rating','event_requests.feedback','event_requests.tentative_date','event_requests.handover_date','event_requests.closer_date','request_types.name','event_requests.created_at','users.name as resName')
                    ->leftJoin('request_types','request_types.id', '=', 'event_requests.request_type')
                    ->leftJoin('users','users.id', '=', 'event_requests.resv_id')
                    ->Where('event_requests.req_email','=', $userEmail)
                    ->whereIn('event_requests.status',['WIP','On Hold','Information Awaiting','Feedback Awaiting'])
                    ->orderby('event_requests.id', 'DESC')->get();
                }elseif($name == 'close'){
                    $userEmail = session('email');
                    $resolverData = User::where('location', '=', session('region'))->get();
                    $datas = EventRequest::select('event_requests.id','event_requests.req_email','event_requests.req_name','event_requests.resv_id','event_requests.priority','event_requests.subject','event_requests.status','event_requests.description','event_requests.attachment','event_requests.rating','event_requests.feedback','event_requests.tentative_date','event_requests.handover_date','event_requests.closer_date','request_types.name','event_requests.created_at','users.name as resName')
                    ->leftJoin('request_types','request_types.id', '=', 'event_requests.request_type')
                    ->leftJoin('users','users.id', '=', 'event_requests.resv_id')
                    ->Where('event_requests.req_email','=', $userEmail)
                    ->whereIn('event_requests.status',['Closed'])
                    ->orderby('event_requests.id', 'DESC')->get();
                }else{
                    $userEmail = session('email');
                    $resolverData = User::where('location', '=', session('region'))->get();
                    $datas = EventRequest::select('event_requests.id','event_requests.req_email','event_requests.req_name','event_requests.resv_id','event_requests.priority','event_requests.subject','event_requests.status','event_requests.description','event_requests.attachment','event_requests.rating','event_requests.feedback','event_requests.tentative_date','event_requests.handover_date','event_requests.closer_date','request_types.name','event_requests.created_at','users.name as resName')
                    ->leftJoin('request_types','request_types.id', '=', 'event_requests.request_type')
                    ->leftJoin('users','users.id', '=', 'event_requests.resv_id')
                    ->Where('event_requests.req_email','=', $userEmail)
                    ->orderby('event_requests.id', 'DESC')->get();
                }

            }elseif(session('userType') == 'resolver'){

                if($name == 'active'){
                    $region = session('region');
                    $resolverData = User::where('location', '=', session('region'))->get();
                    $datas = EventRequest::select('event_requests.id','event_requests.req_email','event_requests.req_name','event_requests.resv_id','event_requests.priority','event_requests.subject','event_requests.status','event_requests.description','event_requests.attachment','event_requests.rating','event_requests.feedback','event_requests.tentative_date','event_requests.handover_date','event_requests.closer_date','request_types.name','event_requests.created_at','users.name as resName')
                    ->leftJoin('request_types','request_types.id', '=', 'event_requests.request_type')
                    ->leftJoin('users','users.id', '=', 'event_requests.resv_id')
                    ->Where('event_requests.req_region', '=',$region)
                    ->Where('event_requests.resv_id', '=',session('userid'))
                    ->whereIn('event_requests.status',['WIP','On Hold','Information Awaiting','Feedback Awaiting'])
                    ->orderby('event_requests.id', 'DESC')->get();
                }elseif($name == 'close'){
                    $region = session('region');
                    $resolverData = User::where('location', '=', session('region'))->get();
                    $datas = EventRequest::select('event_requests.id','event_requests.req_email','event_requests.req_name','event_requests.resv_id','event_requests.priority','event_requests.subject','event_requests.status','event_requests.description','event_requests.attachment','event_requests.rating','event_requests.feedback','event_requests.tentative_date','event_requests.handover_date','event_requests.closer_date','request_types.name','event_requests.created_at','users.name as resName')
                    ->leftJoin('request_types','request_types.id', '=', 'event_requests.request_type')
                    ->leftJoin('users','users.id', '=', 'event_requests.resv_id')
                    ->Where('event_requests.req_region', '=',$region)
                    ->Where('event_requests.resv_id', '=',session('userid'))
                    ->whereIn('event_requests.status',['Closed'])
                    ->orderby('event_requests.id', 'DESC')->get();
                }else{               
                    $region = session('region');
                    $resolverData = User::where('location', '=', session('region'))->get();
                    $datas = EventRequest::select('event_requests.id','event_requests.req_email','event_requests.req_name','event_requests.resv_id','event_requests.priority','event_requests.subject','event_requests.status','event_requests.description','event_requests.attachment','event_requests.rating','event_requests.feedback','event_requests.tentative_date','event_requests.handover_date','event_requests.closer_date','request_types.name','event_requests.created_at','users.name as resName')
                    ->leftJoin('request_types','request_types.id', '=', 'event_requests.request_type')
                    ->leftJoin('users','users.id', '=', 'event_requests.resv_id')
                    ->Where('event_requests.req_region', '=',$region)
                    ->Where('event_requests.resv_id', '=',session('userid'))
                    ->orderby('event_requests.id', 'DESC')->get();
                }
            }elseif(session('userType') == 'admin'){
                
                if($name == 'active'){
                    $resolverData = User::where('location', '=', session('region'))->get();
                    $datas = EventRequest::select('event_requests.id','event_requests.req_email','event_requests.req_name','event_requests.resv_id','event_requests.priority','event_requests.subject','event_requests.status','event_requests.description','event_requests.attachment','event_requests.rating','event_requests.feedback','event_requests.tentative_date','event_requests.handover_date','event_requests.closer_date','request_types.name','event_requests.created_at','users.name as resName')
                    ->leftJoin('request_types','request_types.id', '=', 'event_requests.request_type')
                    ->leftJoin('users','users.id', '=', 'event_requests.resv_id')
                    ->whereIn('event_requests.status',['WIP','On Hold','Information Awaiting','Feedback Awaiting'])
                    ->orderby('event_requests.id', 'DESC')->get();
                }elseif($name == 'close'){
                    $resolverData = User::where('location', '=', session('region'))->get();
                    $datas = EventRequest::select('event_requests.id','event_requests.req_email','event_requests.req_name','event_requests.resv_id','event_requests.priority','event_requests.subject','event_requests.status','event_requests.description','event_requests.attachment','event_requests.rating','event_requests.feedback','event_requests.tentative_date','event_requests.handover_date','event_requests.closer_date','request_types.name','event_requests.created_at','users.name as resName')
                    ->leftJoin('request_types','request_types.id', '=', 'event_requests.request_type')
                    ->leftJoin('users','users.id', '=', 'event_requests.resv_id')
                    ->whereIn('event_requests.status',['Closed'])
                    ->orderby('event_requests.id', 'DESC')->get();
                    
                }else{ 
                    $resolverData = User::where('location', '=', session('region'))->get();
                    $datas = EventRequest::select('event_requests.id','event_requests.req_email','event_requests.req_name','event_requests.resv_id','event_requests.priority','event_requests.subject','event_requests.status','event_requests.description','event_requests.attachment','event_requests.rating','event_requests.feedback','event_requests.tentative_date','event_requests.handover_date','event_requests.closer_date','request_types.name','event_requests.created_at','users.name as resName')
                    ->leftJoin('request_types','request_types.id', '=', 'event_requests.request_type')
                    ->leftJoin('users','users.id', '=', 'event_requests.resv_id')
                    ->orderby('event_requests.id', 'DESC')->get();
                }                
            }else{
                $datas = '';
            }      
            return view('request.allrequest', compact('datas','resolverData'));
        }else{
            return redirect()->route('login');
        }
    }
   
    public function store(Request $request)
    {
        $resolverData = User::where('user_type', 2)->where('res_priority',1)->where('location', '=', session('region') )->first();
        
        $this->validate($request, [
            'priority' => 'required',
            'request_type' => 'required',
            'subject' =>'required',
            'description' => 'required',
            'files' => 'mimes:jpeg,jpg,png,pdf,doc,docx|max:2048',
        ]);

        if($request->hasfile('files')){ 
            $file = $request->file('files');
            $file_name =$file->getClientOriginalName();  
            $dataFile =  $file->move('file-data',$file_name); 
        } 
        $data = new EventRequest;
        $data->priority = $request->priority;
        $data->request_type = $request->request_type;
        $data->subject = $request->subject;
        $data->description = $request->description;
        $data->req_email = session('email');
        $data->req_name = session('name');
        $data->req_phone = session('phone');
        $data->req_region = session('region');
        $data->status = 'Open';
        $data->resv_id = $resolverData['id'] ?  $resolverData['id']  : '' ;           
        $data->attachment = isset($file_name) ? $file_name : '';  
        $data->save();   
            
        $reqType = RequestType::find($data->request_type);
        $resolverData = User::find($data->resv_id);
        $requestid = EventRequest::find($data->id);

        if($data != null){        
            Mail::send('EmailTemplats.newrequest', [
                'requestid'            =>$requestid->id,
                'priority'             => $request->priority,
                'requestType'          => $reqType->name,
                'subject'              => $data->subject,
                'description'          => $data->description,
                'requesterEmail'       => $data->req_email,
                'requesterName'        => $data->req_name,
                'requesterRegion'      => $data->req_region,
                'resolverName'         => $resolverData->name,
                'status'               => $data->status,
                'requestdate'          =>$data->created_at,
            ],
                function ($message) use($resolverData, $data){
                    $emailFrom = 'karamalert@karamportals.com';
                    $emlTo  =  $resolverData->email;                   
                    $message->from($emailFrom);
                    $message->to($emlTo, 'Your Name')
                    ->cc([$data->req_email])
                    ->cc('arushi.nigam@karam.in')
                    ->subject('[KARAM - Maintenance] New service request ticket Created Ticket ID #'.$data->id);
                }
            ); 
            return redirect()->route('req.allrequest')->with('success','Service Request created successfully');
        }
    }
    public function edit(Request $request, $id)
    {
        if(session('userType') != null || session('userType') != ''){  
           
            if(session('userType') == 'requester' || session('userType') == 'resolver' || session('userType') == 'admin'){
                
                $findLocation = EventRequest::find(Crypt::decrypt($id));
                $resolverDatas = User::where('location', '=', $findLocation->req_region)->get();               
                $editData = EventRequest::select('event_requests.*','request_types.name as requestType','users.name as resvname')
                ->leftJoin('request_types','request_types.id', '=', 'event_requests.request_type')
                ->leftJoin('users','users.id', '=', 'event_requests.resv_id')
                ->where('event_requests.id', '=',Crypt::decrypt($id))
                ->first();
                $comments  = Comment::where('event_id','=', $editData->id)->orderBy('id', 'DESC')->get();
                return view('request.edit', compact('editData','comments','resolverDatas'));
            }else{
                return Redirect::back();
            }
        }else{
            return redirect()->route('login');
        }
    }

    public function myactive(Request $request)
    {
        if(session('userType') != null || session('userType') != ''){        
            if(session('userType') == 'requester'){
                $userEmail = session('email');
                $resolverData = User::where('location', '=', session('region'))->get();
                $datas = EventRequest::select('event_requests.id','event_requests.req_email','event_requests.req_name','event_requests.resv_id','event_requests.priority','event_requests.subject','event_requests.status','event_requests.description','event_requests.attachment','event_requests.rating','event_requests.feedback','event_requests.tentative_date','event_requests.handover_date','event_requests.closer_date','request_types.name','event_requests.created_at','users.name as resName')
                ->leftJoin('request_types','request_types.id', '=', 'event_requests.request_type')
                ->leftJoin('users','users.id', '=', 'event_requests.resv_id')
                ->Where('event_requests.req_email','=', $userEmail)
                ->whereIn('event_requests.status',['WIP','On Hold','Information Awaiting','Feedback Awaiting'])
                ->orderby('event_requests.id', 'DESC')->get();
            }elseif(session('userType') == 'resolver'){
                
                $region = session('region');
                $resolverData = User::where('location', '=', session('region'))->get();
                $datas = EventRequest::select('event_requests.id','event_requests.req_email','event_requests.req_name','event_requests.resv_id','event_requests.priority','event_requests.subject','event_requests.status','event_requests.description','event_requests.attachment','event_requests.rating','event_requests.feedback','event_requests.tentative_date','event_requests.handover_date','event_requests.closer_date','request_types.name','event_requests.created_at','users.name as resName')
                ->leftJoin('request_types','request_types.id', '=', 'event_requests.request_type')
                ->leftJoin('users','users.id', '=', 'event_requests.resv_id')
                ->Where('event_requests.req_region', '=',$region)
                ->Where('event_requests.resv_id', '=',session('userid'))
                ->whereIn('event_requests.status',['WIP','On Hold','Information Awaiting','Feedback Awaiting'])
                ->orderby('event_requests.id', 'DESC')->get();
            }elseif(session('userType') == 'admin'){
                $resolverData = User::where('location', '=', session('region'))->get();
                $datas = EventRequest::select('event_requests.id','event_requests.req_email','event_requests.req_name','event_requests.resv_id','event_requests.priority','event_requests.subject','event_requests.status','event_requests.description','event_requests.attachment','event_requests.rating','event_requests.feedback','event_requests.tentative_date','event_requests.handover_date','event_requests.closer_date','request_types.name','event_requests.created_at','users.name as resName')
                ->leftJoin('request_types','request_types.id', '=', 'event_requests.request_type')
                ->leftJoin('users','users.id', '=', 'event_requests.resv_id')
                ->whereIn('event_requests.status',['WIP','On Hold','Information Awaiting','Feedback Awaiting'])
                ->orderby('event_requests.id', 'DESC')->get();
            }else{
                $datas = '';
            }      
            return view('request.myactive', compact('datas','resolverData'));
        }else{
            return redirect()->route('login');
        }
    }
    public function myclose(Request $request)
    {
        if(session('userType') != null || session('userType') != ''){        
            if(session('userType') == 'requester'){
                 $userEmail = session('email');
                 $resolverData = User::where('location', '=', session('region'))->get();
                 $datas = EventRequest::select('event_requests.id','event_requests.req_email','event_requests.req_name','event_requests.resv_id','event_requests.priority','event_requests.subject','event_requests.status','event_requests.description','event_requests.attachment','event_requests.rating','event_requests.feedback','event_requests.tentative_date','event_requests.handover_date','event_requests.closer_date','request_types.name','event_requests.created_at','users.name as resName')
                ->leftJoin('request_types','request_types.id', '=', 'event_requests.request_type')
                ->leftJoin('users','users.id', '=', 'event_requests.resv_id')
                ->Where('event_requests.req_email','=', $userEmail)
                 ->whereIn('event_requests.status',['Closed'])
                 ->orderby('event_requests.id', 'DESC')->get();
            }elseif(session('userType') == 'resolver'){
                $region = session('region');
                $resolverData = User::where('location', '=', session('region'))->get();
                $datas = EventRequest::select('event_requests.id','event_requests.req_email','event_requests.req_name','event_requests.resv_id','event_requests.priority','event_requests.subject','event_requests.status','event_requests.description','event_requests.attachment','event_requests.rating','event_requests.feedback','event_requests.tentative_date','event_requests.handover_date','event_requests.closer_date','request_types.name','event_requests.created_at','users.name as resName')
                ->leftJoin('request_types','request_types.id', '=', 'event_requests.request_type')
                ->leftJoin('users','users.id', '=', 'event_requests.resv_id')
                ->Where('event_requests.req_region', '=',$region)
                ->Where('event_requests.resv_id', '=',session('userid'))
                 ->whereIn('event_requests.status',['Closed'])
                 ->orderby('event_requests.id', 'DESC')->get();
            }elseif(session('userType') == 'admin'){
                $resolverData = User::where('location', '=', session('region'))->get();
                $datas = EventRequest::select('event_requests.id','event_requests.req_email','event_requests.resv_id','event_requests.priority','event_requests.subject','event_requests.status','event_requests.description','event_requests.attachment','event_requests.rating','event_requests.feedback','event_requests.tentative_date','event_requests.handover_date','event_requests.closer_date','request_types.name','event_requests.created_at','users.name as resName')
                ->leftJoin('request_types','request_types.id', '=', 'event_requests.request_type')
                ->leftJoin('users','users.id', '=', 'event_requests.resv_id')
                 ->whereIn('event_requests.status',['Closed'])
                 ->orderby('event_requests.id', 'DESC')->get();
            }else{
                 $datas = '';
             }      
             return view('request.myclose', compact('datas','resolverData'));
        }else{
             return redirect()->route('login');
        }
    }
    
}
