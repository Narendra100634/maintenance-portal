<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestType;
use App\Models\EventRequest;
use App\Models\User;
use Log;
use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Hash;
use Redirect;
Use Session;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{
    public function index(){
        if(session('userType') != null || session('userType') != ''){         
            if((session('region') == "DRO")){              
                $locations = User::where('location', '=', 'KTC')->distinct()->where('user_type', 2)->whereIn('location',['KTC','DRO'])->get();
                $users = User::where('location', '=', 'KTC')->where('user_type',2)->distinct()->whereIn('location',['KTC','DRO'])->orderBy('id', 'DESC')->get();
            }else{
                $locations = User::select('location')->distinct()->where('location', '=', session('region'))->where('user_type', 2)->get();
                $users = User::where('location', '=', session('region'))->where('user_type',2);                
                if(session('userType') =="resolver" ){
                    $users =  $users->where('email', session('email')); 
                }
                $users =  $users->orderBy('id', 'DESC')->get();          
            }           
            if(session('userType') == 'admin' && session('region') == 'All' ){
                $locations = User::select('location')->distinct()->where('user_type',2)->orderBy('id', 'ASC')->get();
                $users = User::where('user_type',2)->distinct()->orderBy('id', 'DESC')->get();
            }elseif(session('userType') == 'admin' && session('region') == 'KTC' ){
                $locations = User::select('location')->distinct()->where('user_type',2)->where('location', '=', 'KTC')->orderBy('id', 'ASC')->get();
                $users = User::where('user_type',2)->distinct()->where('location', '=', 'KTC')->orderBy('id', 'DESC')->get();
            }
            $requesttypes = RequestType::where('status', 1)->orderBy('name', 'ASC')->get();
            $eventrequests = EventRequest::orderBy('status', 'ASC')->get();            
            return view('report.index', compact('requesttypes','eventrequests','locations','users'));         
        }else{
            return redirect()->route('login');
        }        
        return view('report.index', compact('requesttypes','eventrequests','users','locations'));
    }
    public function store(Request $request){        
        if($request){  
            $daterange =  explode("-",$request->daterange);
            $fromDate = date("Y-m-d", strtotime($daterange[0])); 
            $toDate = date("Y-m-d", strtotime($daterange[1]));         
            
            $location =  $request->location ? $request->location : '';
             $resolver =  $request->resolver ? $request->resolver : '';

            $requestdata = EventRequest::select('event_requests.id as request_id', 'event_requests.status as status', 'event_requests.req_region as location','request_types.name as request_type','event_requests.req_email as email','event_requests.req_name as name','event_requests.req_phone as phone','users.name as resolver_name','event_requests.priority as priority','event_requests.subject as subject','event_requests.description as description','event_requests.rating as rating','event_requests.feedback as feedback','event_requests.tentative_date as tentative_date','event_requests.handover_date as handover_date','event_requests.closer_date as closer_date','event_requests.created_at as created_at')
            ->leftJoin('request_types', 'event_requests.request_type', '=', 'request_types.id')
            ->leftJoin('users','event_requests.resv_id', '=', 'users.id');

            if(!in_array("all", $request->status)){
                $requests =  $requestdata->whereIn('event_requests.status', $request->status);
            }
            if($request->daterange != null || $request->daterange != '' ){
                $requests =  $requestdata->whereBetween('event_requests.created_at', [$fromDate.'%', $toDate.'%']); 
            }
            if($request->location != 0){
                $requests =  $requestdata->where('event_requests.req_region','=', $location); 
            }
            if($request->resolver != 0){
                $requests =  $requestdata->where('event_requests.resv_id','=', $resolver); 
            }
            if($request->status == "Open" || $request->status == "WIP" || $request->status == "On Hold" || $request->status == "Information Awaiting" || $request->status == "Feedback Awaiting" || $request->status == "Closed"){
                $requests =  $requestdata->where('event_requests.status','=', $status); 
            }
            $requests =  $requestdata->orderBy('event_requests.id', 'DESC')->get();    
            
            $result = "";
            $outtype = "Content-type: application/octet-stream";
            header($outtype);
            $outtype = 'Content-disposition: attachment; filename="Maintenance_report.csv"';
            header($outtype);    
            $result .= '"'.addslashes("SL. No.").'"';
            $result .= ",";            
            $result .= '"'.addslashes("Request Id").'"';
            $result .= ",";
            $result .= '"'.addslashes("Request Date").'"';
            $result .= ",";
            $result .= '"'.addslashes("Request Type").'"';
            $result .= ",";
            $result .= '"'.addslashes("Requster Email").'"';
            $result .= ",";
            $result .= '"'.addslashes("Requster Name").'"';
            $result .= ",";
            $result .= '"'.addslashes("Requster Phone").'"';
            $result .= ",";
            $result .= '"'.addslashes("Request Region").'"';
            $result .= ",";
            $result .= '"'.addslashes("Resolver Name").'"';
            $result .= ",";
            $result .= '"'.addslashes("Priority").'"';
            $result .= ",";
            $result .= '"'.addslashes("Status").'"';
            $result .= ",";
            $result .= '"'.addslashes("Subject").'"';
            $result .= ",";
            $result .= '"'.addslashes("Description").'"';
            $result .= ",";			
            $result .= '"'.addslashes("Rating").'"';
            $result .= ",";
            $result .= '"'.addslashes("Feedback").'"';
            $result .= ",";
            $result .= '"'.addslashes("Tentative Date").'"';
            $result .= ",";
            $result .= '"'.addslashes("Handover Date").'"';
            $result .= ",";
            $result .= '"'.addslashes("Closer Date").'"';
            $result .= ",";
            $result .= "\n";
            
            foreach ($requests as $key => $creative) {
                if($creative->status == 'Open'){
                    $status = 'Open';
                }elseif($creative->status == 'WIP'){
                    $status = 'WIP';
                }elseif($creative->status == 'On Hold'){
                    $status = 'On Hold';
                }elseif($creative->status == 'Information Awaiting'){
                    $status = 'Information Awaiting';
                }elseif($creative->status == 'Feedback Awaiting'){
                    $status = 'Feedback Awaiting';
                }elseif($creative->status == 'Closed'){
                    $status = 'Closed';
                }                
                $keys = $key+1; 
                $result .= '"'.addslashes($keys ? $keys : '').'"';
                $result .= ",";
                $result .= '"'.addslashes($creative->request_id ? $creative->request_id : '' ).'"';
                $result .= ",";
                $result .= '"'.addslashes($creative->created_at ? $creative->created_at : '' ).'"';
                $result .= ",";
                $result .= '"'.addslashes($creative->request_type ? $creative->request_type : '' ).'"';
                $result .= ","; 
                $result .= '"'.addslashes($creative->email ? $creative->email : '' ).'"';
                $result .= ","; 
                $result .= '"'.ucwords($creative->name ? $creative->name : '' ).'"';
                $result .= ","; 
                $result .= '"'.addslashes($creative->phone ? $creative->phone : '' ).'"';
                $result .= ","; 
                $result .= '"'.addslashes($creative->location ? $creative->location : '' ).'"';
                $result .= ","; 
                $result .= '"'.addslashes($creative->resolver_name ? $creative->resolver_name : '' ).'"';
                $result .= ","; 
                $result .= '"'.addslashes($creative->priority ? $creative->priority : '' ).'"';
                $result .= ","; 
                $result .= '"'.addslashes($creative->status ? $creative->status : '' ).'"';
                $result .= ","; 
                $result .= '"'.addslashes($creative->subject ? $creative->subject : '' ).'"';
                $result .= ","; 
                $result .= '"'.addslashes($creative->description ? $creative->description : '' ).'"';
                $result .= ","; 
                $result .= '"'.addslashes($creative->rating ? $creative->rating : '' ).'"';
                $result .= ","; 
                $result .= '"'.strip_tags($creative->feedback ? $creative->feedback : '' ).'"';
                $result .= ","; 
                $result .= '"'.addslashes($creative->tentative_date ? $creative->tentative_date : '' ).'"';
                $result .= ",";  
                $result .= '"'.addslashes($creative->handover_date ? $creative->handover_date : '' ).'"';
                $result .= ",";  
                $result .= '"'.addslashes($creative->closer_date ? $creative->closer_date : '' ).'"';
                $result .= ",";                          
                $result .= "\n";
            }
            print ($result);
            exit();
        }
    }
}
