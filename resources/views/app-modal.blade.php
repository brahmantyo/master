<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
    
  {!! Html::style('/bootstrap/css/bootstrap.min.css') !!}
  {!! Html::style('/fancybox/jquery.fancybox.css') !!}
  {!! Html::style('/fancybox/helpers/jquery.fancybox-buttons.css') !!}

  {!! Html::script('/fancybox/jquery.fancybox.pack.js') !!}
  {!! Html::script('/fancybox/jquery.mousewheel-3.0.6.pack.js') !!}
  <!-- Data Tables -->

  <link href="{{ asset('/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />

@yield('style')
  <!-- jQuery 2.1.3 -->
  <script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
  <!-- jQuery UI 1.11.2 -->
  <script src="{{ asset('/plugins/jQueryUI/jQuery-ui-1.11.2.min.js') }}"></script>

   	
@yield('script')

</head>
<body>
@yield('content')
</body>
</html>