<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Responce;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
Use Session;
Use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;


class PostController extends Controller
{
    public function login(){
        return view('auth.login');
        if(session('userType') != null || session('userType') != ''){  
            if(session('userType') == 'admin'){
                
                return view('auth.login');
            }else{
                return Redirect::back();
            }
        }else{
            return redirect()->route('/');
        }

    }
    public function loginUser(Request $request)
    {     
        $client = new Client();
        $res = $client->request('POST', 'https://karamportals.com/api/', [
            'form_params' => [
                'email' => $request->email,
                'password' => $request->password,
            ]
        ]);
       
        $data = json_decode($res->getBody(), true);
        
        if($data['created_email_id'] !== null && $data['status'] == 200 ){
            $resolver = User::where('email', $data['created_email_id'])->first();           
            if(isset($resolver)){
                if($resolver['user_type']== 1 ){
                    $userType = 'admin';
                    $userId   =  0;
                }elseif($resolver['user_type'] == 2){
                    $userType = 'resolver';
                    $userId   =  $resolver->id;
                }
            }else{
                $userType = 'requester';
                $userId   =  0;
            }    
            session()->put('userid', $userId);
            session()->put('name', $data['employee_name']);
            session()->put('email', $data['created_email_id']);
            session()->put('phone', $data['phone']);
            session()->put('region', $data['region']);
            session()->put('userType', $userType);

           return redirect('dashboard');
        }else{
            return redirect('/')->with('error', 'Invalid Email id or Password'); 
        }
    }
    public function store()
    {
        $response = Http::get('localhost/api/api_fetch_all.php', [
            'email' => 'himanshu.singhal@karam.in',
            'password' => 'Admin@123',
        ]);
		$jsonData = $response->json();
    }

    public function logout()
    {
        \Session::flush();
        \Auth::logout();
        return redirect('/');
    }
}