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
<!--         <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" id="q" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form> -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            @if (($user->level == 'SUPER')&&!(Auth::guest()))
            <li class="treeview">
                <a><i class="fa fa-plus-square-o"></i>Administor Tools</a>
                <ul class="treeview-menu">
                    <li><a href="/user" id="user-manager"><i class="fa fa-user-secret"></i><span>User Manager</span></a></li>
                    <li><a href="#" id="user-manager"><i class="fa fa-user-secret"></i><span>Site Status</span></a></li>
                    <li><a href="#" id="user-manager"><i class="fa fa-user-secret"></i><span>Configuration</span></a></li>
                </ul>
            </li>
            @endif
            
            @if ((($user->level == 'SUPER')||($user->level == 'MANAGER')||($user->level == 'STAFF'))&&!(Auth::guest()))
            <li class="treeview">
                <a><i class="fa fa-plus-square-o"></i><span>Master</span></a>
                <ul class="treeview-menu">
                    <li><a href="/cabang"><i class="fa fa-share-alt"></i>Cabang</a></li>
                    <li><a href="/pegawai"><i class="fa fa-user"></i>Pegawai</a></li>                
                    <li><a href="/konsumen"><i class="fa fa-users"></i>Konsumen</a></li>
                    <li><a href="/armada"><i class="fa fa-truck"></i>Armada</a></li>
                </ul>
            </li>
            @endif
            @if ((($user->level == 'SUPER')||($user->level == 'MANAGER'))&&!(Auth::guest()))
            <li class="treeview">
                <a><i class="fa fa-plus-square-o"></i><span>Laporan</span></a>
                <ul class="treeview-menu">
                    <li><a href="/penagihan" id="menu-penagihan"><i class="fa fa-credit-card"></i>Penagihan</a></li>
<!--                     <li><a href="/mutasi" id="menu-mutasi"><i class="fa fa-calculator"></i>Mutasi</a></li> -->
<!--                     <li><a href="/pendapatan" id="menu-pendapatan"><i class="fa fa-money"></i>Pendapatan</a></li> -->

<!--                     <li><a href="/sjt" id="menu-stj"><i class="fa fa-file-text-o"></i>Surat Jalan Truck</a></li> -->

                </ul>
            </li>
            @endif
            @if ((($user->level == 'SUPER')||($user->level == 'MANAGER')||($user->level == 'STAFF'))&&!(Auth::guest()))
            <li class="treeview">
                <a>
                    <i class="fa fa-pencil-square-o"></i>
                    <span>Transaksi</span>
                    @if($nquotes)
                    <span class="label label-danger">{{$nquotes}}</span>
                    @endif
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/resi" id="menu-resi"><i class="fa fa-print"></i>Resi Pengiriman</a></li>
                    <li><a href="/admin/keberangkatan" id="menu-keberangkatan"><i class="fa fa-print"></i>Daftar Order Trucking</a></li>
                    <li><a href="/quotation" id="menu-orders"><i class="fa fa-calculator"></i>Permintaan Kirim</a></li>
                </ul>
            </li>
            @endif            
            @if ((($user->level == 'SUPER')||($user->level == 'MANAGER')||($user->level == 'STAFF'))&&!(Auth::guest()))
            <li class="treeview">
                <a href="/article" id="article">
                    <i class="fa fa-pencil-square-o"></i><span>Article</span>
                </a>
            </li>
            @endif
            @if (($user->level == 'KONSUMEN')&&!(Auth::guest()))
            <li class="treeview"><a href="/profil" id=""><i class="fa "></i><span>Profil</span></a></li>
            <li class="treeview">
                <a>
                    <i class="fa fa-pencil-square-o"></i>
                    <span>Transaksi</span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview"><a href="/order" id=""><i class="fa "></i><span>Permintaan Kirim</span></a></li>
                    <li class="treeview"><a href="/resi" id=""><i class="fa "></i><span>Daftar Resi Pengiriman</span></a></li>
                </ul>
            </li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>