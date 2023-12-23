<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>KARAM Maintenance Portal Login Page</title>
    <link rel="icon" href="{{asset('/img/favicon.ico')}}" type="image/vnd.microsoft.icon">
    <link href="{{asset('/css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous"/>
  </head>
  <body class="hold-transition login-page">
  <div class="login-logo">
  Reset your Password?
            </div>
            <div class="card">
    <div class="card-body login-card-body"> 
    <div class="form">
                <form class="login-form" action="{{ route('reset.password.post') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="text" id="email_address" class="form-control" value="{{ Crypt::decrypt(Request::get('email'))}}" name="email"  required autofocus>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                         <input type="password" id="password" class="form-control" name="password" placeholder="Password" required autofocus>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        
                            <input type="password" id="password-confirm" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autofocus>
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                         <button type="submit" class="btn-primary">
                            Reset Password
                        </button>
                   
                </form>
</div>
</div>
</div>
            </div>
        </div>
  </body>
</html>
