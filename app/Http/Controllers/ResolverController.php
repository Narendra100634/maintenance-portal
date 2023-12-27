<?php

namespace App\Http\Controllers;

use App\Models\EventRequest;
use App\Models\RequestType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use GuzzleHttp\Client;
use App\Models\User;
Use Session;
use db;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class ResolverController extends Controller
{ 
    public function index()
    {
        
        if(session('userType') != null || session('userType') != ''){
            $datas = User::orderBy('id', 'DESC')->get();
            return view('resolver.index', compact('datas'));
        }else{
            return redirect()->route('login');
        }

    }

    public function create()
    {
        return view('resolver.create');
    }

    public function userList(Request $request, $id)
    {
        $client = new Client();
        $res = $client->request('GET', 'https://karamportals.com/api/email_fetch.php?id='.$id, [
            'form_params' => [
                'email' => $request->email,
            ]
        ]);       
        $data = json_decode($res->getBody(), true);
        return Response::json($data);
    } 

    public function store(Request $request)
    {
        if(session('userType') != null || session('userType') != ''){
            if(session('userType') == 'admin'){
                $this->validate($request, [
                    'name' => 'required |unique:users',
                    'location' => 'required |unique:users',
                    'mobile' => 'required |unique:users',
                    'email' => 'required |unique:users',
                    'status' => 'required|in:1,0',
                   
                ]);
        
                $data = new User;
                $data->user_type = 2;
                $data->name = $request->name;
                $data->email = $request->email;
                $data->location = $request->location;
                $data->mobile = $request->mobile;
                $data->status = $request->status;
                $data->password = 123;       
                $data->save();   

                return redirect()->route('res.index')->with('success','Resolver Created successfully');
            }else{
               return redirect('/')->with('error', 'Employee dose not exist.');
            }
        }else{
            return redirect()->route('login');
        }
    }
    public function edit(Request $request, $id)
    {  
        if(session('userType') != null || session('userType') != ''){
            $editData = User::find(Crypt::decrypt($id));
            return view('resolver.edit', compact('editData'));
        }else{
            return redirect()->route('login');
        }
    }

    public function update(Request $request, $id)
    {
        if(session('userType') != null || session('userType') != ''){
            if(session('userType') == 'admin'){
                $this->validate($request, [
                    'status' => 'required|in:1,0',
                ]);
                $dataUp = User::find(Crypt::decrypt($id));
                $dataUp->email = $request->email;
                $dataUp->name = $request->name;
                $dataUp->location = $request->location;
                $dataUp->mobile = $request->mobile;
                $dataUp->status = $request->status;
                $dataUp->update();
                return redirect()->route('res.index')->with('success','User Updated Successfully'); 
            }else{
                return redirect()->route('dashboard');
            }
        }else{
            return redirect()->route('login');
        }
    }
    public function changeStatus(Request $request)
    {
        $data = User::find($request->id);
        $data->status = $request->status;
        $data->save();
         
        return response()->json(['success' => 'status changed successfully']);
    }

    public function assignto(Request $request)
    {
        $updateResolver = EventRequest::find($request->id);
        $updateResolver->resv_id = $request->resv_id;
        $updateResolver->save();

        $resolverEmail = User::find($updateResolver->resv_id);
        $reqType = RequestType::find($updateResolver->request_type);
        //$eventid = $updateResolver->id;
       if($request->resv_id != null){   
            
            Mail::send('EmailTemplats.assignuser', [
                'requestid'            =>$updateResolver->id,
                'priority'             => $updateResolver->priority,
                'requestType'          => $reqType->name,
                'subject'              => $updateResolver->subject,
                'description'          => $updateResolver->description,
                'requesterEmail'       => $updateResolver->req_email,
                'requesterName'        => $updateResolver->req_name,
                'requesterRegion'      => $updateResolver->req_region,
                'status'               => $updateResolver->status,
                'requestdate'          =>$updateResolver->created_at,
                'resolvername'         =>$resolverEmail->name,
            ],
                function ($message) use($resolverEmail, $updateResolver){
                    $emailFrom = 'karamalert@karamportals.com';
                    $emlTo  =  $resolverEmail->email;                   
                    $message->from($emailFrom);
                    $message->to($emlTo, 'Your Name')
                        ->cc([$updateResolver->req_email])
                        ->bcc('arushi.nigam@karam.in')
                    ->subject('[KARAM - Maintenance] New service request ticket Created Ticket ID #'.$updateResolver->id);
                }
            ); 
        } 
        return response()->json(['success' => 'resolver assign successfully']);

    }
}
