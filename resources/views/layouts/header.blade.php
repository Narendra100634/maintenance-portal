<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>KARAM Maintenance Portal</title>
        <link rel="icon" href="{{asset('/img/favicon.ico')}}" type="image/vnd.microsoft.icon">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}} ">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- DataTables -->
        <!-- <link rel="stylesheet" href="css/dataTables.bootstrap.css"> -->
        <link rel="stylesheet" href="{{asset('/css/dataTables.bootstrap.css')}} ">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('/css/AdminLTE.min.css')}}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
            folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{asset('/css/_all-skins.min.css')}}">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        
        <style>
            table thead{
                background-color: #4c4c4c;
                color:#ffffff;
            }
            table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after {
                opacity: 0.5;
                /* font-family: 'Glyphicons Halflings'; */
            }
            .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
                background-color: #e31e24;
                border-color: #e31e24;
            }
            table.dataTable thead > tr > th{vertical-align:top;}
            .years{padding: 10px 20px;font-size:16px;margin-top:20px;border-radius: 5px;}
        
           .form-control{
			   display: block;
               width: 100%;
               padding: 0.375rem 0.75rem;
               line-height: 1.5;
               color: #495057;
               background-color: #fff;
               background-clip: padding-box;
               border: 1px solid #ced4da;
               border-radius: 0.25rem;
               transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
			}
            label { 
                /* float: left; */
                margin-left: 10px;
                font-size: 15px;
                font-weight: 400;
                margin-top: 6px; 
            } 
            span { 
                overflow: hidden; 
                padding: 0px 4px 0px 0px; 
            } 
            input { 
              width: 70%; 
            } 
            .dashboard-heading{
             color: #566b75;
            }
            .body-line{
                border-top:2px solid #eee;
            }
            .body-attach{
                border-bottom: 2px solid #d94b4b;color:#d94b4b;
            }
            .body-submit{
                margin-top:20px; margin-bottom:10px;
            }
            .btn-body{
                color: #ffffff;font-weight: 600;font-size: 18px;background: #f0303d!important;padding: 10px 30px;border: none;
            }
            .request-body{
                text-align:center;background-color:#d2d6de;font-size:20px;
            }
            .body-line-content{
                border-top:2px solid #eee;margin-top:30px;
            }
            .checked {
                color: orange;
            }
            .box-body-content{
                background-color:#7d70701c; padding:2px 3px 7px 7px;
            }
            .tbl-content{
                border-radius: 4px;border: none;color: white;padding: 4px 15px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;cursor: pointer;background-color: #f39c12
            }
            .form-sbmt{
                margin-top:10px;
            }
	   </style>
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