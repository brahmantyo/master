@extends('app-modal')

@section('style')
<link href="{{ asset('/plugins/datatables/jquery.dataTables.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/plugins/datatables/dataTables.responsive.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/plugins/daterangepicker2/daterangepicker.css') }}" rel="stylesheet" type="text/css" /> 

<link href="{{ asset('/plugins/jqwidgets/styles/jqx.base.css') }}" rel="stylesheet" type="text/css" /> 
<link href="{{ asset('/plugins/jqwidgets/styles/jqx.bootstrap.css') }}" rel="stylesheet" type="text/css" /> 

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
<script src="{{ asset('/plugins/daterangepicker2/moment.js') }}"></script>
<script src="{{ asset('/plugins/daterangepicker2/daterangepicker.js') }}"></script>

<script src="{{ asset('/plugins/jqwidgets/jqxcore.js') }}"></script>
<script src="{{ asset('/plugins/jqwidgets/jqxdata.js') }}"></script>
<script src="{{ asset('/plugins/jqwidgets/jqxbuttons.js') }}"></script>
<script src="{{ asset('/plugins/jqwidgets/jqxscrollbar.js') }}"></script>
<script src="{{ asset('/plugins/jqwidgets/jqxlistbox.js') }}"></script>
<script src="{{ asset('/plugins/jqwidgets/jqxdropdownlist.js') }}"></script>
<script src="{{ asset('/plugins/jqwidgets/jqxdatatable.js') }}"></script>
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
			<table class="dttable display responsive no-wrap" width="100%">
				<tbody>
					<?php
					$tb=0;$dp=0;$ss=0;
					?>
					@foreach($resi as $r)
					<tr>
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
		"order" : [1,"asc"],
		"iDisplayLength": 5,
		"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"responsive":true
	});
	$(document).ready(function(){
	$('-#data').jqxDataTable(
            {
            	width: '100%',
                theme: 'bootstrap',
                pageable: true,
                pagerButtonsCount: 5,
                sortable: true,
                columnsResize: true,
                rowDetails: true,
                columns: [
                  { text: 'No.', dataField: 'No.' },
                  { text: 'Konsumen', dataField: 'Konsumen' },
                  { text: 'Jumlah Resi', dataField: 'Jumlah Resi', align: 'right' },
                  { text: 'Total Biaya', dataField: 'Total Biaya', align: 'right'},
                  { text: 'DP', dataField: 'DP', align: 'right' },
                  { text: 'Sisa', dataField: 'Sisa', align: 'right' }
                ]
            });

	});
</script>
@endsection

@section('help')
<p><b>Shortcut For Laporan Tagihan</b></p>
<hr>
<p>Tekan tombol ... untuk melakukan ...</p>
@yield('coba')
@endsection
