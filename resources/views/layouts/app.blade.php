<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>KARAM Maintenance Portal</title>
        <link rel="icon" href="{{asset('/img/favicon.ico')}}" type="image/vnd.microsoft.icon">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{asset('/css/3.4.1-bootstrap.min.css')}} ">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{asset('/css/1.10.21-dataTables.bootstrap.min.css')}} ">
        
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('/css/AdminLTE.min.css')}}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
            folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{asset('/css/_all-skins.min.css')}}">
        <link rel="stylesheet" href="{{asset('/css/custom.css')}}">
        <link rel="stylesheet" href="{{asset('/css/iziToast.min.css')}}">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- SweetAlert2 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
        
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <a href="{{route('dashboard')}}" class="logo">
                    <span class="logo-mini"><img src="{{asset('/img/karam-icon-logo.png')}}" alt=""></span>
                    <span class="logo-lg"><img src="{{asset('/img/logo (1).png')}}" alt=""></span>
                </a>
                <nav class="navbar navbar-static-top" role="navigation">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="glyphicon glyphicon-user"></i>
                                    <span class="hidden-xs">{{session('name')}}</span>
                                </a>
                            </li>
                            <li class="dropdown messages-menu"> 
                                <a href="{{URL('logout')}}" style=" margin-top: 8px; margin-right: 18px;  border-radius: 5px; padding: 6px 12px; color: #e31e24; background-color:#ffffff; border-color: #ffffff; " class="btn btn-primary btn-flat pull-right" data-toggle="tooltip" data-placement="left" title="" data-original-title="sign out">
                                    <i class="fa fa-sign-out fa-lg" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>  
            @include('layouts.sidebar')
            <div class="content-wrapper">
                @yield('content')
            </div>
            @include('layouts.footer')          
        </div>
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('/js/3.7.1-jquery.min.js')}}"></script>
    <script src="{{asset('/js/3.4.1-bootstrap.min.js')}}"></script>
    <script src="{{asset('/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('/js/1.3.8-jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('/js/1.0.6-fastclick.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('/js/app.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/custom.js')}}"></script>
    <link href=" {{asset('/css/bootstrap-toggle.min.css')}}" rel="stylesheet">
    <script src="{{ asset('/js/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('/js/iziToast.min.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="{{asset('/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

    @if ($errors ->any())
        @foreach ($errors->all as $error)
            <script>
                iziToast.success({
                    title: '',
                    zindex: 99999,
                    position: 'topCenter',
                    message: '{{ $error}}'
               });
            </script>
        @endforeach
    @endif
    @if (session()->get('success'))
        <script>
            iziToast.success({
                title: '',
                zindex: 99999,
                position: 'topCenter',
                message: '{{ session()->get('success') }}'
            });
       </script>
   @endif
</body>
</html>