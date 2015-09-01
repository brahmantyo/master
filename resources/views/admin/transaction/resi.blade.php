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
		<table id="tbresi" class="table table-condensed table-striped table-responsive" width="100%">
			<tbody>
				<?php
					$i=1;
					$total=0;
					$dp=0;
					$sisa=0;
				?>
				@foreach($resis as $resi)
				<tr {{$resi->sisa==0?'style=background:lightgreen':''}}>
					<td>
						<a href="/admin/resi/{{$resi->noresi}}" class="btn btn-success">View</a>
					</td>					
					<td>{{$i}}</td>
					<td>{{\App\Helpers::dateFromMySqlSystem($resi->tglresi)}}</td>
					<td>{{$resi->noresi}}</td>
					<td>{{$resi->pengirim->nama}}</td>
					<td>{{$resi->penerima->nama}}</td>
					<td align="right">{{\App\Helpers::currency($resi->totalbiaya)}}</td>
					<td align="right">{{\App\Helpers::currency($resi->dp)}}</td>
					<td align="right">{{\App\Helpers::currency($resi->sisa)}}</td>
				</tr>
				<?php
					$i++;
					$total += $resi->totalbiaya;
					$dp += $resi->dp;
					$sisa += $resi->sisa;
				?>
				@endforeach
			</tbody>
			<thead>
				<tr>
					<th width="50"></th>
					<th>No.</th>
					<th>Tanggal</th>
					<th>No.Resi</th>
					<th>Pengirim</th>
					<th>Penerima</th>
					<th>Biaya</th>
					<th>DP</th>
					<th>Sisa Biaya</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td></td>					
					<td><b>Total</b></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td align="right">{{\App\Helpers::currency($total)}}</td>
					<td align="right">{{\App\Helpers::currency($dp)}}</td>
					<td align="right">{{\App\Helpers::currency($sisa)}}</td>
				</tr>
			</tfoot>
		</table>
		<div class="panel panel-danger hidden-md hidden-lg">
			<div class="panel-body">
			<div><b>Total Biaya:</b> {{\App\Helpers::currency($total,2,'id')}}</div>
			<div><b>Total DP :</b> {{\App\Helpers::currency($dp,2,'id')}}</div>
			<div><b>Total Sisa Tagihan:</b> {{\App\Helpers::currency($sisa,2,'id')}}</div>
			</div>
		</div>
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
		"order" : [1,"desc"],
		"iDisplayLength": 5,
		"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"responsive":true,
		"pagingType": "full",
        "bStateSave": true,
        "columnDefs":[
        	{"targets":0,"orderable":false}
        ],
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem( 'DataTables', JSON.stringify(oData) );
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse( localStorage.getItem('DataTables') );
        },
		"language": {
		    "sProcessing":   "Sedang memproses...",
		    "sLengthMenu":   "Tampilkan _MENU_ entri",
		    "sZeroRecords":  "Tidak ditemukan data yang sesuai",
		    "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
		    "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
		    "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
		    "sInfoPostFix":  "",
		    "sSearch":       "Cari:",
		    "sUrl":          "",
		    "oPaginate": {
		        "sFirst":    "|<",
		        "sPrevious": "<",
		        "sNext":     ">",
		        "sLast":     ">|"
		    
			}
        }
	});
</script>
@endsection

@section('help')

@endsection