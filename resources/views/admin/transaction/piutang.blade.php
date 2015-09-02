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
<script src="{{ asset('/plugins/datatables/language/bahasa-indonesia.js') }}"></script>
<script src="{{ asset('/plugins/daterangepicker2/moment.js') }}"></script>
<script src="{{ asset('/plugins/daterangepicker2/daterangepicker.js') }}"></script>
@endsection

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <!-- put another before link if exist here -->
    <li class="active">Piutang</li>
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
                <h1><i class='fa fa-credit-card'></i>Piutang</h1>

            </div>
            <div class="box-body">
            @if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{!! $error !!}</div>
                @endforeach
            @endif
			<div class="box-body">
				{!! Form::open(['method'=>'POST'])!!}
				{!! Form::select('konsumen',$konsumen) !!}
				{!! Form::close() !!}
				<table id="tbpiutang" class="display responsive no-wrap" width="100%">
				<tbody>
					@foreach($piutang as $p)
					<tr style="{{$p->status==3?:'background:lightgreen'}}" align="right">
						<td>{{$p->noresi}}</td>
						<td>{{$p->valongkir}}</td>
						<td>{{$p->valdp}}</td>
						<td>{{$p->valsisa}}</td>
					</tr>
					@endforeach
				</tbody>
				<thead>
					<tr>
						<th>No.Resi</th>
						<th>Biaya Kirim</th>
						<th>DP</th>
						<th>Sisa</th>
					</tr>
				</thead>
				</table>
				<div class="well">
					<h5><b>Legend:</b></h5>
					<div class="label label-default">Belum Lunas</div>
					<div class="label label-success">Sudah Lunas</div>
				</div>
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
		width: 1024,
		height: 800,
		openSpeed: 1,
		closeSpeed: 1,
		ajax : {
			dataType : 'html',
		},
		afterClose : function(){ window.location.replace('/admin/keberangkatan') },
	});
	$('#tbpiutang').dataTable({
		"order" : [1,"asc"],
		"iDisplayLength": 5,
		"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"responsive":true,
		"pagingType": "full",
		"bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem( 'DataTables', JSON.stringify(oData) );
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse( localStorage.getItem('DataTables') );
        },
		"language": language
	});
</script>
@endsection

@section('help')
<p><b>Shortcut For Laporan berangkat</b></p>
<hr>
<p>Tekan tombol ... untuk melakukan ...</p>
@endsection
