@extends('app')

@section('style')

@endsection

@section('script')
@endsection

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active">Daftar Resi Pengiriman</li>
</ol>
@endsection

@section('content')
<style>
	#resipengiriman {
		display:none;
	}
</style>

<div class="box">
	<div class="box-header">
    	<span><h1><i class="fa fa-print"></i>Daftar Resi Pengiriman</h1></span>
	</div>
	<div class="box-body">

		<div>
		<table id="tbresi" class="table table-condensed table-striped">
			<tbody>
				<?php $i=1; ?>
				@foreach($resis as $resi)
				<tr>
					<td>{{$i}}</td>
					<td>{{$resi->tglresi}}</td>
					<td>
						<a href="/admin/resi/{{$resi->noresi}}" class="btn btn-success">View</a>
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
<script type="text/javascript">
	$('a:contains("View")').fancybox({
		type : 'iframe',
		href : this.value,
		autoSize: false,
		height: 800,
		openSpeed: 1,
		closeSpeed: 1,
		ajax : {
			dataType : 'html',
		},
		afterClose : function(){ window.location.replace('/admin/resi') },
	});
	$('#tbresi').dataTable({
		"order" : [1,"asc"],
		"iDisplayLength": 5,
		"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"responsive":true
	});
</script>
@endsection

@section('help')

@endsection