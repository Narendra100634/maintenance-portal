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

    
    <div class="login-logo">
               Sign In
            </div> 
            <div class="card">
                <div class="card-body login-card-body">
                    <!-- <p class="login-box-msg"><img class="profile-img" src="../img/photo.png" alt="user"></p> -->
                    <p class="login-box-msg"><img class="profile-img" src="{{asset('img/photo.png')}}" alt="user"></p>
      <div class="form">
       
        
        @if (Session::has('error'))
         <p class="text-danger">{{Session::get('error') }}</p>
        @endif
        @if (Session::has('success'))
         <p class="text-success">{{Session::get('success') }}</p>
        @endif

        <form class="login-form" action="{{route('login-user')}}" method="post" >
          @csrf
          <input type="text" name="email" placeholder="Email" value="{{old('email')}}"/>
          <span class="text-danger">@error('email'){{message}} @enderror </span>
          <input type="password" name="password" placeholder="password"/>
          <span class="text-danger">@error('password'){{message}} @enderror </span>

          
          <button type="submit">Sign In</button>
        </form><br>
        <label><a href="{{ route('forget.password.get') }}">Forgot Password</a></label>
      </div>
      </div>
   </div>
  </body>
</html>
