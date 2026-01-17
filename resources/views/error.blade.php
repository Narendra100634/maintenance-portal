<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('/img/favicon.ico')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- App css -->
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />
    <!-- icons -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light bg">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6 col-xl-4">
        <div class="text-center mb-3">   
          <a href="#">
              <img src="{{asset('img/logo-dark.png')}}" alt="logo"  class="mx-auto">
          </a>
        </div>         
        <div class="card p-4" style="max-width: 500px; width: 100%;">  
          <div class="d-flex justify-content-center ">
            <div class="alert d-flex justify-content-center align-items-center display-1">
              <img src="{{asset('img/icon-error.png')}}" alt="error"  class="mx-auto">
            </div>
          </div>
          <h3 class="text-center mb-4">Something went Wrong</h3>
          <p class="text-center mb-4">The email address you provided is not registered in this application.  </p>
          <p>For assistance, Please contact <a class="red" href="mailto:anu.puri@karam.in">Administrator</a>.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="copyright">© 2025, All rights reserved by KARAM Safety Pvt. Ltd.</div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <style>
    .card {
      box-shadow: 0px 0px 12px #e7e7e7;
    }                                
    .copyright {
      text-align: center;
      width: 100%;
      padding: 25px;
      display: inline-block;
      font-size: 11px;
      color: #999999;
      position: absolute;
      bottom:0px
    }
    .btn-outline {
      border: 1px solid #f0303d;
      border-radius: 5px;
      background: #ffffff;
    }
    .bg {
      background: #f5f5f5 url(assets/images/bg-01.jpg) no-repeat;
      background-size: cover;
      background-position: bottom right;
      background-attachment: fixed;
    }
    .btn-outline:hover{background:#ffffff; border:1px solid #f0303d;}
    .red{color:#f0303d;}    
  </style>
</body>
</html>
