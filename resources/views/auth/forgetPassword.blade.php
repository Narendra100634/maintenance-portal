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
  <div class="karam-logo"><img class="" src="{{ asset('img/logo.png') }}" alt="karam-logo"></div>
  <div class="login-logo">
  Reset your Password?
            </div>
            <div class="card">
    <div class="card-body login-card-body"> 
      <div class="form">
        @if(Session::has('message'))
          <p class="error-msg error-msg-alert alert {{ Session::get('alert-class', 'alert-info') }}">{{ 
            Session::get('message') }}
          </p>
        @endif
        <form class="login-form" action="{{ route('forget.password.post') }}" method="post" >
            @csrf
            <input type="text" id="email_address" class="form-control @if($errors->has('email')) is-invalid @endif" value="{{ old('email') }}" name="email" placeholder="Email id" required>
            @if($errors->has('email'))
              <div class="invalid-feedback error-msg">{{$errors->first('email')}}</div>
            @endif
            <button type="submit" class=" btn-primary">Reset Password</button>
        </form> 
        <br>
        <label><a href="{{route('login')}}">Sign In</a></label>       
      </div>
    </div>
    </div>
  </body>
</html>
