<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @if (Auth::guard('superadmin')->check())
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
        <a class="nav-link" href="{{ url('superadmin') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
    
        <!-- Divider -->
        <hr class="sidebar-divider">
    
        <!-- Heading -->
        <div class="sidebar-heading">
        Menu
        </div>
    
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Master</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('superadmin/lapak') }}">Lapak</a>
                <a class="collapse-item" href="{{ url('superadmin/factory') }}">Factory</a>
                </div>
            </div>
        </li>
    @elseif(Auth::guard('lapak')->check())
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
        <a class="nav-link" href="{{ url('lapak') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
    
        <!-- Divider -->
        <hr class="sidebar-divider">
    
        <!-- Heading -->
        <div class="sidebar-heading">
        Menu
        </div>
    
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Master</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ url('lapak/pemulung') }}">Pemulung</a>
                    <a class="collapse-item" href="{{ url('lapak/client') }}">Client</a>
                    <a class="collapse-item" href="{{ url('lapak/factory') }}">Factory</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThre" aria-expanded="true" aria-controls="collapseThre">
                <i class="fas fa-fw fa-cog"></i>
                <span>Garbage In</span>
            </a>
            <div id="collapseThre" class="collapse" aria-labelledby="headingThre" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ url('lapak/porequest') }}">Requested List</a>
                    <a class="collapse-item" href="{{ url('lapak/pobook') }}">Booked List</a>
                    <a class="collapse-item" href="{{ url('lapak/popick') }}">Picked List</a>
                    <a class="collapse-item" href="{{ url('lapak/poreceiving') }}">Receiving</a>
                
                </div>
            </div>
            
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-garbage-out" aria-expanded="true" aria-controls="collapseThre">
                <i class="fas fa-fw fa-cog"></i>
                <span>Garbage Out</span>
            </a>
            <div id="collapse-garbage-out" class="collapse" aria-labelledby="headingThre" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('lapak.sales.order') }}">Sales Order</a>
                    <a class="collapse-item" href="{{ route('lapak.good.issue') }}">Goods Issue</a>
                    <a class="collapse-item" href="{{ route('lapak.invoice') }}">Invoice</a>
               </div>
            </div>            
        </li>

       
        
    @endif



</ul>
<!-- End of Sidebar -->