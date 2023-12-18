<h1>Forget Password Email</h1>
   
You can reset password from bellow link:
<a href="{{ route('reset.password.get', ['email'=> Crypt::encrypt($email),'token' => $token ])}}">Reset Password</a>
