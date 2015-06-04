<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
    
    {!! Html::style('/bootstrap/css/bootstrap.min.css') !!}
	{!! Html::style('/fancybox/jquery.fancybox.css') !!}
	{!! Html::style('/fancybox/helper/jquery.fancybox-buttons.css') !!}

	{!! Html::script('/fancybox/jquery.fancybox.pack.js') !!}
	{!! Html::script('/fancybox/jquery.mousewheel-3.0.6.pack.js') !!}

</head>
<body>
@yield('content')
</body>
</html>