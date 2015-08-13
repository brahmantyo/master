@extends('app')

@section('style')

@endsection

@section('script')
@endsection

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active">Daftar Resi Pengiriman</li>
</ol>
@endsection

@section('content')
<style>
	#resipengiriman {
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
	<a href="#resipengiriman" id="bCari" class="modalbox"><u>C</u>ari</a>
	<div class="box-header">
    	<span><h1><i class="fa fa-print"></i>Daftar Resi Pengiriman</h1></span>
	</div>
	<div class="box-body">
		<div id="resipengiriman" class="col-lg-12">
			<form action="resipengiriman" method="post" role="form" class="form">
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
			<tbody>
				<?php $i=1; ?>
				@foreach($resis as $resi)
				<tr>
					<td>{{$i}}</td>
					<td>{{$resi->tglresi}}</td>
					<td>
						<a href="/admin/resi/{{$resi->noresi}}" class="btn btn-success">Lihat</a>
					</td>
				</tr>
				<?php $i++; ?>
				@endforeach
			</tbody>
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
<p><b>Shortcut For Resi Pengiriman</b></p>
<hr>
<p>Tekan tombol C untuk melakukan pencarian daftar resi pengiriman</p>
@endsection