@extends('app')

@section('style')

@endsection

@section('script')
@endsection

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active">Laporan Mutasi</li>
</ol>
@endsection

@section('content')
<style>
	#mutasi {
		display:none;
	}
</style>
<script>
	var mlistener = new window.keypress.Listener();
	mlistener.simple_combo("c", function(){
    	$('#bCari').click();
	});
</script>
<div class="box">
	<a href="#mutasi" id="bCari" class="modalbox"><u>C</u>ari</a>
	<div class="box-header">
    	<span><h1><i class="fa fa-calculator"></i>Laporan Mutasi Kas</h1></span>
	</div>
	<div class="box-body">
		<div id="mutasi" class="col-lg-12">
			<form action="mutasi" method="post" role="form" class="form">
				<div class="form-group">
				<label>Cabang</label>
				<select class="form-control">
					<option>Bandung</option>
					<option>Medan</option>
				</select>
				</div>
				<div class="form-group">
				<label>Periode</label>
				<input  class="form-control date" type="text" placeholder="Tanggal Awal">
				<input  class="form-control date" type="text" placeholder="Tanggal Akhir">
				</div>
				<button class="form-control" type="submit" >Search</button>
			</form>
	</div>
		<div>
		<table class="table table-condensed table-striped">
		<thead>
			<tr>
			<th>No.</th>
			<th>Tanggal</th>
			<th>Control</th>
			</tr>
		</thead>
		</table>
		</div>
	</div>
</div>
@endsection

@section('help')
<p><b>Shortcut For Mutasi</b></p>
<hr>
<p>Tekan tombol C untuk melakukan pencarian laporan mutasi</p>
@endsection