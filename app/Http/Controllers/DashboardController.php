<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EventRequest;
use App\Models\RequestType;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function index(){ 
        
        if(session('userType') != null || session('userType') != ''){        
            if(session('userType') == 'requester'){
                
                $userEmail = session('email');
                $resolverData = User::where('location', '=', session('region'))->get();
                $datas = EventRequest::select('event_requests.id','event_requests.req_email','event_requests.req_name','event_requests.resv_id','event_requests.priority','event_requests.subject','event_requests.status','event_requests.description','event_requests.attachment','event_requests.rating','event_requests.feedback','event_requests.tentative_date','event_requests.handover_date','event_requests.closer_date','request_types.name','event_requests.created_at','users.name as resName')
                ->leftJoin('request_types','request_types.id', '=', 'event_requests.request_type')
                ->leftJoin('users','users.id', '=', 'event_requests.resv_id')
                ->Where('event_requests.req_email','=', $userEmail)
                ->whereIn('event_requests.status',['Open'])
                ->orderby('event_requests.id', 'DESC')->get();
                $total = EventRequest::where('req_email', $userEmail)->get()->count();
                $totalactive = EventRequest::where('req_email', $userEmail)->whereIn('status',['Open','WIP','Feedback Awaiting','On Hold','Information Awaiting'])->count();
                $totalclose = EventRequest::where('req_email', $userEmail)->where('status',['Closed'])->count();

            }elseif(session('userType') == 'resolver'){
               
                $region = session('region');
                $resolverData = User::where('location', '=', session('region'))->get();
                if($region == 'KTC'){
                    $region = [$region,'DRO'];
                }else{
                    $region = [session('region')];
                }
                $datas = EventRequest::select('event_requests.id','event_requests.req_email','event_requests.req_name','event_requests.resv_id','event_requests.priority','event_requests.subject','event_requests.status','event_requests.description','event_requests.attachment','event_requests.rating','event_requests.feedback','event_requests.tentative_date','event_requests.handover_date','event_requests.closer_date','request_types.name','event_requests.created_at','users.name as resName')
                ->leftJoin('request_types','request_types.id', '=', 'event_requests.request_type')
                ->leftJoin('users','users.id', '=', 'event_requests.resv_id')
                ->WhereIn('event_requests.req_region',$region)
                ->Where('event_requests.resv_id', '=',session('userid'))
                ->whereIn('event_requests.status',['Open'])
                ->orderby('event_requests.id', 'DESC')->get();
                $total = EventRequest::where('event_requests.resv_id', '=',session('userid'))->count();
                $totalactive = EventRequest::where('event_requests.resv_id', '=',session('userid'))
                ->whereIn('event_requests.status',['Open','WIP','Feedback Awaiting','On Hold','Information Awaiting'])->count();
                $totalclose = EventRequest::where('event_requests.resv_id', '=',session('userid'))
                ->whereIn('event_requests.status',['Closed'])->count();
            }elseif(session('userType') == 'admin'){
                
                $region = session('region');
                
                if($region == 'KTC'){
                    $region = [$region,'DRO'];
                }else{
                    $region = [session('region')];
                }
                if(session('region') !='All'){
                    $datas = EventRequest::select('event_requests.id','event_requests.req_email','event_requests.req_name','event_requests.resv_id','event_requests.priority','event_requests.subject','event_requests.status','event_requests.description','event_requests.attachment','event_requests.rating','event_requests.feedback','event_requests.tentative_date','event_requests.handover_date','event_requests.closer_date','request_types.name','event_requests.created_at','users.name as resName')
                    ->leftJoin('request_types','request_types.id', '=', 'event_requests.request_type')
                    ->leftJoin('users','users.id', '=', 'event_requests.resv_id')
                    ->whereIn('event_requests.status',['Open'])
                    ->whereIn('event_requests.req_region',$region)
                    ->orderby('event_requests.id', 'DESC')->get();

                    $resolverData = User::where('location', '=', session('region'))->get();
                    $total = EventRequest::whereIn('req_region',$region)->count();
                    $totalactive = EventRequest::whereIn('status',['Open','WIP','Feedback Awaiting','On Hold','Information Awaiting'])->whereIn('req_region',$region)->count();
                    $totalclose = EventRequest::where('status',['Closed'])->whereIn('req_region',$region)->count();
                }else{
                    $datas = EventRequest::select('event_requests.id','event_requests.req_email','event_requests.req_name','event_requests.resv_id','event_requests.priority','event_requests.subject','event_requests.status','event_requests.description','event_requests.attachment','event_requests.rating','event_requests.feedback','event_requests.tentative_date','event_requests.handover_date','event_requests.closer_date','request_types.name','event_requests.created_at','users.name as resName')
                    ->leftJoin('request_types','request_types.id', '=', 'event_requests.request_type')
                    ->leftJoin('users','users.id', '=', 'event_requests.resv_id')
                    ->whereIn('event_requests.status',['Open'])
                    ->orderby('event_requests.id', 'DESC')->get();

                    $resolverData = User::where('location', '=', session('region'))->get();
                    $total = EventRequest::count();
                    $totalactive = EventRequest::whereIn('status',['Open','WIP','Feedback Awaiting','On Hold','Information Awaiting'])->count();
                    $totalclose = EventRequest::where('status',['Closed'])->count();
                }
                
             } else{
                $datas = '';
            }      
            return view('dashboard', compact('datas','resolverData','total','totalactive','totalclose'));
        }else{
            return redirect()->route('login');
        }
    }
    public function edit(Request $request, $id)
    {
        if(session('userType') != null || session('userType') != ''){  
            if(session('userType') == 'requester'){
                $resolverData = User::where('location', '=', session('region'))->get();
                $requests = RequestType::where('status', 1)->get();
                $editData = EventRequest::find($id);
               
                return view('request.edit-request', compact('editData','requests','resolverData'));
               
            }else{
                return Redirect::back();
            }
            
        }else{
            return redirect()->route('login');
        }
    }
}
