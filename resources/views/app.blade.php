<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Name | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="_token" content="{{ csrf_token() }}"/>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="{{ asset('/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="{{ asset('/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="{{ asset('/dist/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="{{ asset('/plugins/iCheck/flat/blue.css') }}" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="{{ asset('/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="{{ asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="{{ asset('/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
    <!-- Date Range Picker -->
    <link href="{{ asset('/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css" />

    <!-- Fancy Box -->
    {!! Html::style('/bootstrap/css/bootstrap.min.css') !!}
    {!! Html::style('/fancybox/jquery.fancybox.css') !!}
    {!! Html::style('/fancybox/helpers/jquery.fancybox-buttons.css') !!}    

    @yield('style')

    <!-- jQuery 2.1.3 -->
    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="{{ asset('/plugins/jQueryUI/jQuery-ui-1.11.2.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
       $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>    
    <!-- Morris.js charts -->
    <script src="{{ asset('/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="{{ asset('/plugins/sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="{{ asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('/plugins/knob/jquery.knob.js') }}" type="text/javascript"></script>
   <!-- datepicker -->
    <script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/plugins/datepicker/locales/bootstrap-datepicker.id.js') }}" charset="UTF-8"></script>    
    <!-- daterangepicker -->
    <script src="{{ asset('/plugins/daterangepicker/daterangepicker.js') }}" charset="UTF-8"></script>    
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="{{ asset('/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="{{ asset('/plugins/fastclick/fastclick.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/dist/js/app.min.js') }}" type="text/javascript"></script>
    
    <!--Input Masking -->
    <script src="{{ asset('plugins/inputmask/inputmask.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.js') }}" type="text/javascript"></script>    

    <!-- Shortkey -->
    {!! Html::script('/plugins/keypress/keypress-2.1.0.min.js') !!}

    <!-- Fancy Box -->
    {!! Html::script('/fancybox/jquery.fancybox.pack.js') !!}
    {!! Html::script('/fancybox/jquery.mousewheel-3.0.6.pack.js') !!}

    @yield('script')
</head>
<body class="skin-red fixed"><!-- sidebar-collapse -->
    <div class="wrapper">
        <?php $user = Auth::user(); ?>
        @include('includes.header')
        @include('includes.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content">
            <!-- Content Header (Page header) -->
                @yield('content-header')
            <!-- Main content -->
                @yield('content')
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                Press F1 for help
            </div>
            <b>Version</b> 1.5.2 || <strong>Copyright &copy; 2014-2015 <a href="#">Niclogic</a>.</strong> All rights reserved.
        </footer>
    </div><!-- ./wrapper -->

    <script type="text/javascript">
        $('.modalbox').fancybox({
                autoSize: false,
                openSpeed: 100,
        });
        $(document).ready(function(){
            //Shortkey dictionary
/*            var frontkeys = [
                {
                    "keys"          : "f1",
                    "is_exclusive"  : true,
                    "on_keyup"      : function(event) {
                        $('#help').click();    
                        return true;
                    },
                    "this"          : this
                },
                {
                    "keys"          : "f10",
                    "is_exclusive"  : true,
                    "on_keyup"      : function(event) {
                        window.location.replace("/auth/logout");
                        return true;
                    },
                    "prevent_default": true,
                    "this"          : this
                },
                {
                    "keys"          : "meta p",
                    "is_exclusive"  : true,
                    "on_keyup"      : function(event) {
                        $('#user-profile').eq(0).click();    
                        return true;
                    },
                    "prevent_default": true,
                    "this"          : this
                },
                @if(\Auth::user()->level!='KONSUMEN')
                {
                    "keys"          : "ctrl u",
                    "is_exclusive"  : true,
                    "on_keyup"      : function(event) {
                        $('#user-manager').click();    
                        return true;
                    },
                    "prevent_default": true,
                    "this"          : this
                },
                {
                    "keys"          : "ctrl m",
                    "is_exclusive"  : true,
                    "on_keyup"      : function(event) {
                        $('#menu-mutasi').click();
                        return true;
                    },
                    "prevent_default": true,
                    "this"          : this
                },
                {
                    "keys"          : "ctrl d",
                    "is_exclusive"  : true,
                    "on_keyup"      : function(event) {
                        $('#menu-pendapatan').click();
                        return true;
                    },
                    "prevent_default": true,
                    "this"          : this
                },
                {
                    "keys"          : "ctrl t",
                    "is_exclusive"  : true,
                    "on_keyup"      : function(event) {
                        $('#menu-penagihan')[0].click();
                        return true;
                    },
                    "prevent_default": true,
                    "this"          : this
                },
                {
                    "keys"          : "ctrl r",
                    "is_exclusive"  : true,
                    "on_keyup"      : function(event) {
                        $('#menu-resi').click();
                        return true;
                    },
                    "prevent_default": true,
                    "this"          : this
                },
                {
                    "keys"          : "ctrl j",
                    "is_exclusive"  : true,
                    "on_keyup"      : function(event) {
                        $('#menu-sjt').click();
                        return true;
                    },
                    "prevent_default": true,
                    "this"          : this
                },
                @endif
            ];


            var listener = new window.keypress.Listener();
            var keylist = listener.register_many(frontkeys);       

            $('input')
                 .bind("focus", function() { listener.stop_listening(keylist); })
                 .bind("blur", function() { listener.listen(keylist); });

            $('textarea')
                 .bind("focus", function() { listener.stop_listening(keylist); })
                 .bind("blur", function() { listener.listen(keylist); });

            $('input[type=text]:first').focus();*/
        });
        
    </script>

    @if(\Auth::user()->level=='KONSUMEN'&&!(\Config::get('registered')))
    <script type="text/javascript">
    $(document).ready(function(){
        $.fancybox.open({
            type : 'iframe',
            href : '/start',
            height: 800,
            openSpeed: 1,
            closeSpeed: 1,
            closeBtn: false,
            keys : {
                close  : null
            },
            ajax : {
                dataType : 'html',
            },
            afterClose : function(data){
                if(data=='success'){
                    window.location.replace('/konsumenpanel');
                }else{
                    window.location.replace('/');
                }
            },
            helpers:{
                overlay:{
                    locked : false,
                    closeClick: false,
                },
            }
        });
    });
    </script>
    @endif
    <!-- Hidden area -->
    <div id="help" class="modalbox">
    <p><b>Shortcut For Keyboard</b></p>
    <hr>
    <p>F1 = menampilkan halaman bantuan ini</p>
    <p>F10 = Logout</p>
    <p>Ctrl + P = menampilkan Profile User</p>

    <p></p>
    @if(\Auth::user()->level!='KONSUMEN')   
    <p>Ctrl + M = Laporan Mutasi</p>
    <p>Ctrl + D = Laporan Pendapatan</p>
    <p>Ctrl + T = Laporan Penagihan</p>
    <p>Ctrl + R = Daftar Resi Penagihan</p>
    <p>Ctrl + J = Daftar Surat Jalan Truck</p>
    @endif
    <hr>
    @yield('help')
    </div>

    <style type="text/css">
        .modalbox {
            display:none;
        }
    </style>
</body>
</html>
