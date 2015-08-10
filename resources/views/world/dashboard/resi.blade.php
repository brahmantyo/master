@extends('app')
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/konsumenpanel"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active"><i class="fa fa-truck"></i>Daftar Resi</li>
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
				<span><h1><i class="fa fa-truck"></i>Daftar Resi<h1></span>
			</div>

			<div class="box-body">
				<table id="tbresi" class="display responsive no-wrap" width="100%">
				<tbody>
				@foreach($resis as $resi)
					<tr>
						<td>{{\App\Helpers::dateFromMySqlSystem($resi->tglresi)}}</td>
						<td>{{$resi->noresi}}</td>
						<td>{{($resi->pengirim->nama)&&($resi->pengirim->nama!='-')?$resi->pengirim->nama:$resi->pengirim->cp}}</td>
						<td>{{($resi->penerima->nama)&&($resi->penerima->nama!='-')?$resi->penerima->nama:$resi->penerima->cp}}</td>
						<td>{{$resi->tipe}}</td>
						<td>{{\App\Helpers::currency($resi->totalbiaya)}}</td>
						<td>{{\App\Helpers::currency($resi->dp)}}</td>
						<td>{{\App\Helpers::currency($resi->sisa)}}</td>
						<td>{{\App\Helpers::currency($resi->tagihan)}}</td>
						<td>{{\App\Helpers::getResiStatus($resi->status)}}</td>
						<td><a href="/resi/{{$resi->noresi}}" class="btn btn-success">Lihat</a></td>
					</tr>
				@endforeach
				</tbody>
				<thead>
					<tr>
						<th>Tgl</th>
						<th>No.Resi</th>
						<th>Pengirim</th>
						<th>Penerima</th>
						<th>Tipe</th>
						<th>Tot.Biaya</th>
						<th>DP</th>
						<th>Sisa</th>
						<th>Penagihan</th>
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
		afterClose : function(){ window.location.replace('/resi') },
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