<aside class="main-sidebar">
    <section class="sidebar">              
        <ul class="sidebar-menu">
            <li class="header">Karam Maintenance Portal</li>
            <li class="active"> <a class="nav-link active" href="{{route('dashboard')}}"><i class="fa fa-dashboard "></i> <span>Dashboard</span></a></li> 
            @if (session('userType') == 'admin') 
            <li class="treeview">
                <a href="#"><i class="fa fa-pie-chart"></i><span>Master</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                <li class=""> <a href="{{route('res.index')}}"><i class="fa fa-circle-o "></i> <span>Manage Resolver</span></a></li> 
                <li class=""> <a href="{{route('reqtype.index')}}"><i class="fa fa-circle-o "></i> <span>Manage Requset Type</span></a></li>
                </ul>
            </li> 
            @endif
            <li class="treeview">
                <a href="#"><i class="fa fa-pie-chart"></i><span>Requests</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                <li class=""> <a href="{{route('req.allrequest')}}"><i class="fa fa-circle-o "></i> <span>All Requests</span></a></li> 
                <li class=""> <a href="{{route('req.myactive')}}"><i class="fa fa-circle-o "></i> <span>My Active Request</span></a></li>
                <li class=""> <a href="{{route('req.myclose')}}"><i class="fa fa-circle-o "></i> <span>My Close Request</span></a></li>
                </ul>
            </li> 
        </ul>                    
    </section>
</aside>         