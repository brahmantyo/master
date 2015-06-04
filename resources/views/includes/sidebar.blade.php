<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset($user->photo) }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ $user->first_name.' '.$user->last_name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" id="q" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            @if (($user->level == 'SUPER')&&!(Auth::guest()))
            <li class="treeview">
                <a href="/user" id="user-manager">
                    <i class="fa fa-user"></i><span>User Manager</span>
                </a>
            </li>
            @endif
            <li class="treeview">
                <a href="/penjualan">
                    <i class="fa fa-user"></i><span>Laporan</span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/mutasi" id="menu-mutasi">Mutasi</a></li>
                    <li><a href="/pendapatan" id="menu-pendapatan">Pendapatan</a></li>
                    <li><a href="/penagihan" id="menu-penagihan">Penagihan</a></li>
                    <li><a href="/resipengiriman" id="menu-resi">Resi Pengiriman</a></li>
                    <li><a href="/sjt" id="menu-stj">Surat Jalan Truck</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>