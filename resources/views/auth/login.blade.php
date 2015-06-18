<!DOCTYPE html>
<html>
<head>
<title>Lanogan Sumatra Express</title>
<meta name="author" content="bram" >
<meta name="date" content="2015-06-17T04:26:13+0700" >
<meta name="copyright" content="niclogic">
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8">
<meta http-equiv="content-style-type" content="text/css">
<meta http-equiv="expires" content="0">
<link href="core.css" rel="stylesheet" type="text/css">
<script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>

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
	position: absolute;
	top: 1px;
	right: 1px;
	z-index: 3;
	display: none;
	text-shadow: 2px 2px #999;
}
#footer {
	background-image: url('{{ asset("/dist/img/title.png") }}');
	background-repeat: no-repeat;
	background-position: center;
	position: absolute;
	bottom: 0px;
	width: 98%;
}

</style>
<script type="text/javascript">
$(document).ready(function() {
	$('#link').mouseover(function(){ 
		$('#login').show();
		$('[name="name"]').focus();
	});
	$('#link').mouseout(function() { $('#login').hide(); });
});

</script>
</head>
<body>
	<div id="footer"><br><br><br><br><br><br><br></div>
	<div class="menu" >
		<span class="menu-items">
			<a href="#">Lacak Pengiriman</a> :: <a href="#">Tentang Kami</a>
		</span>
		<span class="menu-login">
			<a id="link">Login
			<div id="login" onblur="$(this).hide()">
				<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
			
					<div class="form-group">
						<label class="col-md-4 control-label">Login</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name" value="{{ old('name') }}">
						</div>
					</div>
			
					<div class="form-group">
						<label class="col-md-4 control-label">Password</label>
						<div class="col-md-6">
							<input type="password" class="form-control" name="password">
						</div>
					</div>
			
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">Login</button>
						</div>
					</div>
				</form>
			</div>
			</a>
		</span>
	</div>
</body>
</html>