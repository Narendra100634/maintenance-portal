<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
Use Session;

class AzureController extends Controller
{
   public function redirectToProvider()
    {
        return Socialite::driver('microsoft')->scopes(['openid', 'profile', 'email', 'offline_access', 'user.read'])->redirect();
    }

    public function handleProviderCallback()
    {        
        $azureUser = Socialite::driver('microsoft')->user();
        // dd($azureUser);

        $locationUser = $azureUser->user['officeLocation'];
        if($locationUser == 'CO' || $locationUser == 'DRO' || $locationUser == 'ARO'|| $locationUser == 'BRO'|| $locationUser == 'CRO'|| $locationUser == 'CTRO'|| $locationUser == 'KRO'|| $locationUser == 'LRO'|| $locationUser == 'MRO'|| $locationUser == 'PBO'|| $locationUser == 'BBO'|| $locationUser == 'KTC'|| $locationUser == 'ORO' || $locationUser == 'HRO'|| $locationUser == 'CHRO'){        
            
            $checkUser = User::where('email', $azureUser->user['mail'])->where('status', 1)->first(); 

            if($checkUser == null){
                $user = User::Create(
                    [
                        'email' => $azureUser->user['mail'],
                        'name' => $azureUser->user['displayName'],
                        'location' => $azureUser->user['officeLocation'],
                        'mobile' => $azureUser->user['mobilePhone'] ? $azureUser->user['mobilePhone'] : '',
                        'status' => 1,
                        'user_type' => 3
                    ]
                );
            }           
            
            $resolver = User::where('email',$azureUser->user['mail'])->where('status', 1)->first(); 
            if(isset($resolver['user_type'])){

                if($resolver['user_type']== 1 ){
                    $userType = 'admin';
                    $userId   =  0;
                    $region =  $resolver->location;
                    session()->put('userType', $userType);
                }
                elseif($resolver['user_type'] == 2){
                    $userType = 'resolver';
                    $userId   =  $resolver->id;
                    $region   =  $resolver->location;
                    session()->put('userType', $userType);
                }elseif($resolver['user_type'] == 3){
                    $userId   =  0;
                    $userType = 'requester';
                    $userId   =  $resolver->id;
                    $region   =  $resolver->location;
                    session()->put('userType', $userType);
                }

                session()->put('userid', $userId);
                session()->put('name', $resolver['name']);
                session()->put('email', $resolver['email']);
                session()->put('phone', $resolver['mobile']);
                session()->put('region', $resolver['location']);
                return redirect()->route('dashboard');
            }else{
                return redirect('/error');
            }
        }else{
            return redirect('/error')->with('error', 'You are not authorized for this Application'); 
        }
    }
}
