<aside class="main-sidebar">
    <section class="sidebar">              
        <ul class="sidebar-menu">
            <li class="header">Karam Maintenance Portal</li>
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}"> <a class="nav-link" href="{{route('dashboard')}}"><i class="fa fa-dashboard "></i> <span>Dashboard</span></a></li> 
            @if (session('userType') == 'admin') 
            <li class="treeview {{ ( (Request::segment(1) == 'resolver') || (Request::segment(1) == 'request-type') )  ? 'active' : '' }}">
                <a href="#"><i class="fa fa-book"></i><span>Master</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class=" {{ (Request::segment(1) == 'resolver') ? 'active' : '' }}"> <a href="{{route('res.index')}}"><i class="fa fa-circle-o "></i> <span>Manage Resolver</span></a></li> 
                    <li class="{{ (Request::segment(1) == 'request-type')  ? 'active' : '' }} "> <a href="{{route('reqtype.index')}}"><i class="fa fa-circle-o "></i> <span>Manage Requset Type</span></a></li>
                </ul>
            </li> 
            @endif
            <li class="treeview {{ ( (Request::segment(3) == 'all') || (Request::segment(3) == 'active') || (Request::segment(3) == 'close') )  ? 'active' : '' }}">
                <a href="#"><i class="fa fa-file-text"></i><span>Requests</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu ">
                <li class=" {{ (Request::segment(3) == 'all') ? 'active' : '' }}"> <a href="{{route('req.allrequest','all')}}"><i class="fa fa-circle-o "></i> <span>All Requests</span></a></li> 
                <li class=" {{ (Request::segment(3) == 'active') ? 'active' : '' }}"> <a href="{{route('req.allrequest','active')}}"><i class="fa fa-circle-o "></i> <span>My Active Request</span></a></li>
                <li class="{{ (Request::segment(3) == 'close') ? 'active' : '' }} "> <a href="{{ route('req.allrequest','close') }}"><i class="fa fa-circle-o "></i> <span>My Close Request</span></a></li>
                </ul>
            </li> 
        </ul>                    
    </section>
</aside>         