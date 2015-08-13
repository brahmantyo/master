@extends('app')

@section('style')
<link href="{{ asset('/plugins/datatables/jquery.dataTables.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/plugins/datatables/dataTables.responsive.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/plugins/daterangepicker2/daterangepicker.css') }}" rel="stylesheet" type="text/css" /> 
<style type="text/css">
.new {
 		background-color: #F5A9A9 !important;
 	}
</style>
@endsection

@section('script')
<script src="{{ asset('/plugins/datatables/jquery.dataTables-1.10.6.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('/plugins/daterangepicker2/moment.js') }}"></script>
<script src="{{ asset('/plugins/daterangepicker2/daterangepicker.js') }}"></script>
@endsection

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <!-- put another before link if exist here -->
    <li class="active">Laporan Keberangkatan</li>
</ol>
@endsection

@section('content')
<style type="text/css">
	.new {
	 		background-color: #F5A9A9 !important;
	 	}
</style>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-credit-card'></i>Daftar Order Trucking</h1>

            </div>
            <div class="box-body">
            @if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{!! $error !!}</div>
                @endforeach
            @endif
			<div class="box-body">
				<table id="tbberangkat" class="display responsive no-wrap" width="100%">
				<tbody>
					@foreach($berangkat as $b)
					<tr class="{{$b->tglberangkat==''?'':'new'}}" align="right">
						<td>{{$b->idberangkat}}</td>
						<td>{{$b->nopolisi}}</td>
						<td>{{$b->sopir->nama}}</td>
						<td>{{$b->kenek->nama}}</td>
						<td>{{$b->asal->nama}}</td>
						<td>{{$b->tujuan->nama}}</td>
						<td>{{\App\Helpers::dateFromMySqlSystem($b->tglberangkat)}}</td>
						<td>{{$b->tgltiba}}</td>
						<td>{{$b->status}}</td>
						<td>
							<!-- <a href="/admin/keberangkatan/{{$b->idberangkat}}" class="btn btn-warning">View</a> -->
						</td>
					</tr>
					@endforeach
				</tbody>
				<thead>
					<tr>
						<th>No.SJT</th>
						<th>No.Polisi</th>
						<th>Sopir</th>
						<th>Kenek</th>
						<th>Asal</th>
						<th>Tujuan</th>
						<th>Tgl.Berangkat</th>
						<th>Tgl.Tiba</th>
						<th>Status</th>
						<th></th>
					</tr>
				</thead>
				</table>
			</div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //Date range picker
    $('.date').daterangepicker();

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
		@if(\Auth::user()->level=='KONSUMEN')
		afterClose : function(){ window.location.replace('/penagihan') },
		@else
		afterClose : function(){ window.location.replace('/penagihan') },
		@endif
	});
	$('#tbberangkat').dataTable({
		"order" : [1,"asc"],
		"iDisplayLength": 5,
		"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"responsive":true
	});
</script>
@endsection

@section('help')
<p><b>Shortcut For Laporan berangkat</b></p>
<hr>
<p>Tekan tombol ... untuk melakukan ...</p>
@yield('coba')
@endsection


@section('coba')
ini percobaan
@endsection