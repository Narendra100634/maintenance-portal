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
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"> -->
  </head>
  <body class="hold-transition login-page">
    
        
  <div class="card">
            <div class="form">
                <form action="{{ route('reset.password.post') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group row">
                        <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                        <div class="col-md-6">
                            <input type="text" id="email_address" class="form-control" value="{{ Crypt::decrypt(Request::get('email'))}}" name="email"  required autofocus>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
                        <div class="col-md-6">
                            <input type="password" id="password" class="form-control" name="password" required autofocus>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                        <div class="col-md-6">
                            <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Reset Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
  </body>
</html>
