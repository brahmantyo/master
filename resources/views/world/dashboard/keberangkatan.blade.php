@extends('app')
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/konsumenpanel"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active"><i class="fa fa-truck"></i>Daftar Resi Keberangkatan</li>
</ol>
@endsection

@section('content')
<style type="text/css">
	.new-quote {
	 		background-color: #F5A9A9 !important;
	 	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<span><h1><i class="fa fa-truck"></i>Daftar Resi Keberangkatan<h1></span>
			</div>
			@if ($errors->has())
			@foreach ($errors->all() as $error)
			<div class='bg-danger alert'>{!! $error !!}</div>
			@endforeach
			@endif
			<div class="box-body">
				<table id="tbresi" class="display responsive no-wrap" width="100%">
				<tbody>
				
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
				
				</tbody>
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>No.SJN</th>
						<th>Pengirim</th>
						<th>Penerima</th>
						<th>Kota Penerima</th>
						<th>Tipe</th>
						<th>Status</th>
						<th></th>
					</tr>
				</thead>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('a:contains("Lihat")').fancybox({
		type : 'iframe',
		href : this.value,
		height: 800,
		openSpeed: 1,
		closeSpeed: 1,
		ajax : {
			dataType : 'html',
		},
		@if(\Auth::user()->level=='KONSUMEN')
		afterClose : function(){ window.location.replace('/keberangkatan') },
		@else
		afterClose : function(){ window.location.replace('/keberangkatan') },
		@endif
	});

	$('#tbresi').dataTable({
		"order" : [1,"desc"],
		"iDisplayLength": 5,
		"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"responsive": true,
		"pagingType" : "full_numbers",
	});
</script>
@endsection

@section('script')
<script src="{{ asset('/plugins/datatables/jquery.dataTables-1.10.6.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables/dataTables.bootstrap.js') }}"></script>
@endsection

@section('style')
<link href="{{ asset('/plugins/datatables/jquery.dataTables.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/plugins/datatables/dataTables.responsive.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" /> 
@endsection