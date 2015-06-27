<!DOCTYPE html>
<html>
<head>
<title>Lanogan Sumatra Express</title>
@yield('meta-author')
@yield('meta-keywords')
@yield('meta-description')
<meta name="date" content="2015-06-17T04:26:13+0700" >
<meta name="copyright" content="niclogic">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8">
<meta http-equiv="content-style-type" content="text/css">
<meta http-equiv="expires" content="0">
<link href="core.css" rel="stylesheet" type="text/css">
<!-- Bootstrap 3.3.2 -->
<link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

<script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>    

<style type="text/css">
body {
	background: url('{{ asset("/dist/img/bg.png") }}');
	background-repeat: no-repeat;
	background-attachment: fixed;
	background-position: center; 
}
a {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
.menu {
	position: relative;
	top: 15px;
	height: 50px;
	background-color: rgba(255,104,30,0.5);
	background-position: top;
	font-family: arial, helvetica, sans-serif;
	color: #ffffff;
}
.menu a {
	color: #ffffff;
	font-family: arial;
	font-size: 15pt;
}
.menu-items {
	position: absolute;
	left: 20px;
	top: 10px;
}
.menu .menu-login {
	position:absolute;
	right: 20px;
	top: 10px;
}
#login {
	border-style: solid;
	border-radius: 10px;
	background-color: #ffffff;
	border-width: 1px;
	border-color: #ff681e;
	padding: 10px;
	background-color: rgba(255,104,30,0.2);
	position: fixed;
	top: 50px;
	right: 1px;
	z-index: 100;
	display: none;
	text-shadow: 2px 2px #999;

}
#footer {
	background-image: url('{{ asset("/dist/img/title.png") }}');
	background-repeat: no-repeat;
	background-position: center;
	position: fixed;
	bottom: 0px;
	width: 98%;
	z-index: -1;
}

</style>
<script type="text/javascript">
$(document).ready(function() {
	$('#link').on('click',function(){ 
		$('#login').toggle();
		$('[name="name"]').focus();
	});
	$(':not(div)').on('click',function(){
		//$('#login').hide();
	});
});

</script>
</head>
<body>
	<div class="menu" class="col-lg-12 	hidden-phone">
		<span class="menu-items nav">
			<a href="/">Home</a> :: 
			<a href="#">Lacak Pengiriman</a> :: 
			<div class="nav-header"><a href="/about">Tentang Kami</div>
				<div class="nav nav-body">
					<div>
						jflkajflkj
					</div>
				</div>
			</a>
		</span>
		<span class="menu-login">
			<a id="link">
			<div class="pull-right">Login</div></a>
			<div id="login" class="col-lg-3">
				<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group col-lg-12">
						<label class="control-label pull-left">Login</label>
						<div class="pull-right">
							<input type="text" class="form-control" name="name" value="{{ old('name') }}">
						</div>
					</div>
					<div class="form-group col-lg-12">
						<label class="control-label pull-left">Password</label>
						<div class="pull-right">
							<input type="password" class="form-control" name="password">
						</div>
					</div>
					<div class="form-group col-lg-12">
						<div class="">
							<button type="submit" class="btn btn-primary">Login</button>
						</div>
					</div>
				</form>
			</div>
			
		</span>
	</div>
	<div>
		@yield('content')
	</div>
	<div id="footer"><br><br><br><br><br><br><br></div>
</body>
</html>