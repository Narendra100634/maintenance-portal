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
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/clean-blog.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <style>
      @import url(https://fonts.googleapis.com/css?family=Roboto:300);

      .login-page {
        width: 360px;
        padding: 8% 0 0;
        margin: auto;
      }
      .form {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        max-width: 360px;
        margin: 0 auto 100px;
        padding: 45px;
        text-align: center;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
      }
      .form input {
        font-family: "Roboto", sans-serif;
        outline: 0;
        background: #f2f2f2;
        width: 100%;
        border: 0;
        margin: 0 0 15px;
        padding: 15px;
        box-sizing: border-box;
        font-size: 14px;
      }
      .form button {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        background: #e31e24;
        width: 100%;
        border: 0;
        padding: 15px;
        color: #FFFFFF;
        font-size: 14px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
        border-radius:5px;
      }
      .form button:hover,.form button:active,.form button:focus {
        background: #e31e24;
      }
      .form .message {
        margin: 15px 0 0;
        color: #b3b3b3;
        font-size: 12px;
      }
      .form .message a {
        color: #4CAF50;
        text-decoration: none;
      }
      .form .register-form {
        display: none;
      }
      .container {
        position: relative;
        z-index: 1;
        max-width: 300px;
        margin: 0 auto;
      }
      .container:before, .container:after {
        content: "";
        display: block;
        clear: both;
      }
      .container .info {
        margin: 50px auto;
        text-align: center;
      }
      .container .info h1 {
        margin: 0 0 15px;
        padding: 0;
        font-size: 36px;
        font-weight: 300;
        color: #1a1a1a;
      }
      .container .info span {
        color: #4d4d4d;
        font-size: 12px;
      }
      .container .info span a {
        color: #000000;
        text-decoration: none;
      }
      .container .info span .fa {
        color: #EF3B3A;
      }
      body {
        background: #f7f7f7; /* fallback for old browsers */
        background: -webkit-linear-gradient(right, #f7f7f7, #ffffff);
        background: -moz-linear-gradient(right, #f7f7f7, #ffffff);
        background: -o-linear-gradient(right, #f7f7f7, #ffffff);
        background: linear-gradient(to left, #f7f7f7, #ffffff);
        font-family: "Roboto", sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;      
      }
      .profile-img{border-radius:100%;}
    </style>
    <div class="login-page"> 
      <div class="form">
        @if(Session::has('message'))
          <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ 
            Session::get('message') }}
          </p>
        @endif
        <form class="login-form" action="{{ route('forget.password.post') }}" method="post" >
            @csrf
            <input type="text" id="email_address" class="form-control @if($errors->has('email')) is-invalid @endif" value="{{ old('email') }}" name="email" placeholder="Email id" required>
            @if($errors->has('email'))
              <div class="invalid-feedback error-msg">{{$errors->first('email')}}</div>
            @endif
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>        
      </div>
    </div>
  </body>
</html>
