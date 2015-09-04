<?php 
    //$user = Auth::user();
?>
<header class="main-header">
    <!-- Logo -->
    <?php if(Auth::user()->level!='KONSUMEN'){
        $home = '/admin';
    }else{
        $home = '/konsumenpanel';
    }
    ?>
    <a href="{{ $home }}" class="logo hidden-xs">LANOGAN</a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="{{$home}}" class="hidden-sm hidden-md hidden-lg col-xs-12 label label-warning">LANOGAN SUMATRA EXPRESS</a>
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li><a href="/"><i class="fa fa-home"></i> Halaman Depan</a></li>
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-success">{{$notification['all']}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Ada <b>{{$notification['all']}}</b> pemberitahuan</li>
                        <li>
                            <ul class="menu">
                            @if($notification['quote']['count']>0)
                                <li>
                                    <span>Ada {{$notification['quote']['count']}} quote web baru <a href="/quotation" class="view-all">(tampilkan)</a></span>
                                </li>
                                @foreach($notification['quote']['all'] as $q)
                                <li>
                                    <a href="/quotation/{{$q->id}}" class="notification-item">
                                        <i class="fa fa-shopping-cart"></i> {{$q->id}}
                                    </a>
                                </li>
                                @endforeach
                            @endif
                            @if($notification['sjt']['count']>0)
                                <li>
                                    <span>Ada {{$notification['sjt']['count']}} keberangkatan baru <a href="/admin/keberangkatan" class="view-all">(tampilkan)</a></span>
                                </li>
                                @foreach($notification['sjt']['all'] as $sjt)
                                <li>
                                    <a href="/admin/keberangkatan/{{$sjt->idberangkat}}" class="notification-item">
                                        <i class="fa fa-truck"></i> {{$sjt->idberangkat}}
                                        <p>Supir:{{$sjt->supir1}}</p>
                                    </a>
                                </li>
                                @endforeach
                            @endif
                            </ul>
                        </li>
<!--                       <li class="footer"><a href="#">See All Messages</a></li> -->
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" id="user-profile" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ asset($user->photo) }}" class="user-image" alt="User Image"/>
                    <span class="hidden-xs">{{ $user->first_name.' '.$user->last_name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ asset($user->photo) }}" class="img-circle" alt="User Image" />
                            <p>
                            {{ $user->first_name.' '.$user->last_name }} - {{ $user->level }}
                            <small>Member since {{ $user->created_at->format('d F Y h:ia') }}</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
<!--                         <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li> -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
<!--                             <div class="pull-left">
                                <a href="/user/{{$user->id}}" class="btn btn-default btn-flat">Profile</a>
                            </div> -->
                            <div class="pull-right">
                                <a href="/auth/logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<script type="text/javascript">
    $('.notification-item').fancybox({
        type : 'iframe',
        href : this.value,
        autoSize: false,
        width: 1024,
        height: 800,
        openSpeed: 1,
        closeSpeed: 1,
        ajax : {
            dataType : 'html',
        },
    });
</script>