<?php 
  
namespace App\Http\Controllers; 
  
use Illuminate\Http\Request; 
use DB; 
use Carbon\Carbon; 
use Mail; 
use Hash;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use Illuminate\Http\Client\Responce;
use Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class ForgotPasswordController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {
        return view('auth.forgetPassword');
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request){ 
        $client = new Client();
        $res = $client->request('GET', 'https://karamportals.com/api/resetPassword.php?email='.$request->email, []);
        $data = json_decode($res->getBody(), true);       
        
        if ($data['status'] == 200) {          
          $token = Str::random(64);  
          DB::table('password_reset_tokens')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);
          Mail::send('EmailTemplats.forgetPassword', ['token' => $token, 'email'=>$request->email], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
          });          
          $message = 'We have e-mailed your password reset link!';
          return back()->with('message', $message);
        }else {
          $message = 'Enter valid Email';
          return back()->with('message', $message)->withInput();
        }
        
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
        public function showResetPasswordForm(Request $request,  $token) { 
        
          $checkEmail = DB::table('password_reset_tokens')
          ->where([
              'email' =>Crypt::decrypt($request->email) , 
              'token' => $request->token
            ])->first();

          if(isset($checkEmail->email)){
            return view('auth.resetPassword', ['token' => $token]);
          }else{
            return redirect::route('login');
          }        
        }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request){         
          $updatePassword = DB::table('password_reset_tokens')->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])->first();
  
          if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
          }else{

            $client = new Client();
            $res = $client->request('POST', 'https://karamportals.com/api/updatepassword.php', [

              'form_params' => [
                'email' => $request->email,
                'password' => $request->password,
              ]
            ]);
            $data = json_decode($res->getBody(), true);       
            
            if ($data['status'] == 200) {          
              return redirect::route('/')->with('success', 'Your password has been changed!');

            }else {              
              return redirect::route('login');
            }

          }

      }
}