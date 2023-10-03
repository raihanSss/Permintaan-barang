<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-text mx-3">PT Rekadaya Multi Adiprima</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    @if($authuser->role == "purchasing")
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Purchase Order</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data:</h6>
                <a class="collapse-item" href="{{ url('suratpo') }}">Purchase Order Request</a>
                <a class="collapse-item" href="{{ url('newpo') }}">Purchase Order</a>
        </div>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('schedule') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Schedule</span></a>
            </li>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

    @elseif ($authuser->role == "ppic")
    <li class="nav-item">
        <a class="nav-link" href="{{ url('penerimaan') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Penerimaan</span></a>
        </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('barang') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Bahan Baku</span></a>
                </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ url('suppliers') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Supplier</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('users') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Data User</span></a>
        </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item">
    <a class="nav-link" href="{{ url('laporan') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Laporan</span></a>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

@elseif ($authuser->role == "direktur")
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item">
    <a class="nav-link" href="{{ url('validasiPO') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Purchase Order</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('rekap') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Rekapitulasi</span></a>
        </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

@elseif ($authuser->role == "supplier")
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item">
    <a class="nav-link" href="{{ url('pengirimanpo') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Penerimaan Surat PO</span></a>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
@endif