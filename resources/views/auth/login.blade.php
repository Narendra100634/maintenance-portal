<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="robots" content="noindex,nofollow">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>KARAM Maintenance Portal Login Page</title>
    <link rel="icon" href="{{asset('/img/favicon.ico')}}" type="image/vnd.microsoft.icon">
    <link href="{{asset('/css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous"/>
    <style>                                          
      .divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 10px 0;
      }
      .divider::before,.divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid #666;
      }
      .divider span {
        padding: 5px 6px;
        border-radius: 50%;
        background: white;
        color: #555;
      }

      .btn-sso {
        color: #212529;
        /* font-family:"Poppins"; */
        background: #ffffff;
        padding: 10px 15px;
        font-size: 14px;
        cursor: pointer;
        border-radius: 5px;
        border: 1px solid #f0303d;
        display: flex; 
        align-items: center; 
        justify-content: center; 
        gap: 10px;
        margin-bottom:15px;
        font-weight: 500;
      }

      a:hover {
        color: #333333;
        font-size: 14px;
      }

      .btn:hover {
        padding: 15px 22px;
        margin: 0px 0px 0px 0px;
      }

      a {
        border-color: red;
        color: #333333;
        text-decoration: none;
      }
    </style>
  </head>
  <body class="hold-transition login-page">
    
      
      <div class="karam-logo"><img class="" src="{{ asset('img/karam-logo.svg') }}" width="200" height="auto" alt="karam-logo"></div>
        <div class="card">
          <div class="card-body login-card-body">
          <div class="login-logo">Sign In</div> 
            <p class="login-box-msg"><img class="profile-img" src="{{asset('img/photo.png')}}" alt="user"></p>
            <div class="form">
              @if (Session::has('error'))
                <p class="error-msg error-msg-alert text-danger text-center">{{Session::get('error') }}</p>
              @endif
              @if (Session::has('success'))
                <p class="error-msg-alert text-success">{{Session::get('success') }}</p>
              @endif

              <!-- <form class="login-form" action="{{route('login-user')}}" method="post" >
                @csrf
                <input type="text" name="email" placeholder="Email" value="{{old('email')}}"/>
                <span class="text-danger">@error('email'){{message}} @enderror </span>
                <input type="password" name="password" placeholder="password"/>
                <span class="text-danger">@error('password'){{message}} @enderror </span>
                <button type="submit">Sign In</button>
              </form>  
              <div>
                <label><a href="{{ route('forget.password.get') }}">Reset Password</a></label> 
              </div>      
              <div class="divider">
                <span>or</span>
              </div>  -->
              <div class="mt-4 row">               
                <a href="{{ url('login/azure')}}" class="btn-sso" ><img src="https://learning.karamonline.com/images/microsoft-logo.svg"><span> Login via single sign-on (SSO)</span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
