@extends('app-modal')

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
<script src="{{ asset('/plugins/datatables/jquery.dataTables.rowGrouping.js') }}"></script>
<script src="{{ asset('/plugins/datatables/language/bahasa-indonesia.js') }}"></script>
<script src="{{ asset('/plugins/daterangepicker2/moment.js') }}"></script>
<script src="{{ asset('/plugins/daterangepicker2/daterangepicker.js') }}"></script>

@endsection

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <!-- put another before link if exist here -->
    <li class="active">Laporan Tagihan</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">

            </div>
            <div class="box-body">
            @if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{!! $error !!}</div>
                @endforeach
            @endif
			<div class="box-body">
			<center><h3>Tagihan Konsumen {{$resi[0]->tagihan=="Pengirim"?$resi[0]->pengirim->nama:$resi[0]->penerima->nama}}</h3></center>
            <table class="table table-responsive table-condensed table-striped table-hover no-margin">
				<tr>
					<th width="20%">Nama Perusahaan</th><td width="30%">: {{$k->nama}}</td>
					<th width="20%">Contact Person</th><td width="30%">: {{$k->cp}}</td>
				</tr>
				<tr>
					<th>Alamat</th><td>: {{$k->alamat}}</td>
					<th>Email</th><td>: {{$k->email}}</td>
				</tr>
				<tr>
					<th>Kota</th><td>: {{$k->dtkota?$k->dtkota->nmkota:'-'}}</td>
					<th></th><td></td>
				</tr>
				<tr>
					<th>Telp</th><td>: {{$k->telp}}</td>
					<th></th><td></td>
				</tr>
			</table>
			<table class="dttable display responsive no-wrap" width="100%">
				<tbody>
					<?php
					$tb=0;$dp=0;$ss=0;
					?>
					@foreach($resi as $r)
					<tr>
						<td>{{\App\Helpers::dateFromMySqlSystem($r->tglresi)}}</td>
						<td>{{$r->noresi}}</td>
						<td>{{\App\Helpers::getResiStatus($r->status)}}</td>
						<td align="right">{{\App\Helpers::currency($r->totalbiaya)}}</td>
						<td align="right">{{\App\Helpers::currency($r->dp)}}</td>
						<td align="right">{{\App\Helpers::currency($r->sisa)}}</td>
					</tr>
					<?php
						$tb += $r->totalbiaya;
						$dp += $r->dp;
						$ss += $r->sisa;
					?>
					@endforeach
				</tbody>
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>No.Resi</th>
						<th>Status Pengiriman</th>
						<th>Total Biaya</th>
						<th>DP</th>
						<th>Sisa</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td align="right">{{\App\Helpers::currency($tb)}}</td>
						<td align="right">{{\App\Helpers::currency($dp)}}</td>
						<td align="right">{{\App\Helpers::currency($ss)}}</td>
					</tr>
				</tfoot>
			</table>

			</div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //Date range picker
    $('.date').daterangepicker();


	$('.dttable').dataTable({
		"order" : [0,"asc"],
		"iDisplayLength": 5,
		"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"responsive":true,
		"pagingType": "full",
		"language": language
	});
</script>
@endsection

@section('help')
<p><b>Shortcut For Laporan Tagihan</b></p>
<hr>
<p>Tekan tombol ... untuk melakukan ...</p>
@yield('coba')
@endsection
