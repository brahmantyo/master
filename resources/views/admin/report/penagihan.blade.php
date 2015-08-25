@extends('app')

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
				<div>
					{!! Form::open(['url'=>'/admin/penagihan/tagihan-cabang','method'=>'GET']) !!}
					{!! Form::select('cabang',$cabang) !!}
					{!! Form::submit('Tagihan Cabang') !!}
					{!! Form::close() !!}
				</div>
				<!-- -->
				@if(isset($list))
				<table id="data" class="dttable display responsive no-wrap" width="100%">
				<tbody>
				@foreach($list as $i=>$l)
				<tr>
					<td></td>
					<td>{{$l['konsumen']}}</td>
					<td>{{$l['jmlresi']}}</td>
					<td>{{$l['totalbiaya']}}</td>
					<td>{{$l['dp']}}</td>
					<td>{{$l['sisa']}}</td>
					<td>
						<a href="/admin/penagihan/tagihan-cabang/?k={{$i}}">Detail</a>
					</td>
				</tr>
				@endforeach
				</tbody>
				<thead>
				<tr>
					<th>No.</th>
					<th>Konsumen</th>
					<th>Jumlah Resi</th>
					<th>Total Biaya</th>
					<th>DP</th>
					<th>Sisa</th>
					<th></th>
				</tr>
				</thead>
				</table>
				@endif
			</div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //Date range picker
    $('.date').daterangepicker();

	$('a:contains("Detail")').fancybox({
		type : 'iframe',
		href : this.value,
		autoSize: false,
		height: 800,
		openSpeed: 1,
		closeSpeed: 1,
		ajax : {
			dataType : 'html',
		},
	});
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
                  { text: 'Jumlah Resi', dataField: 'Jumlah Resi' },
                  { text: 'Total Biaya', dataField: 'Total Biaya'},
                  { text: 'DP', dataField: 'DP' },
                  { text: 'Sisa', dataField: 'Sisa' }
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


@section('coba')
ini percobaan
@endsection