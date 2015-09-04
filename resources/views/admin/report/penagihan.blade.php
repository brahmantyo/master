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
    <li class="active">Laporan Tagihan</li>
</ol>
@endsection

@section('content')
<style type="text/css">
	.lunas {
		background-color: lightgreen;
	}
	.belum {
		background-color: #9892;	
	}
</style>
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
			
<!-- 				<div>
					{!! Form::open(['url'=>'/admin/penagihan/tagihan-cabang','method'=>'GET','class'=>'form-inline']) !!}
					<div class="form-group">
					{!! Form::label('cabang','Daftar cabang',['class'=>'sr-only']) !!}
					<div class="input-group" style="background-color:@brand-info">
					<div class="input-group-addon">Daftar Cabang</div>
					{!! Form::select('cabang',$cabang,$cab,['class'=>'form-control']) !!}
					</div>
					</div>
					{!! Form::submit('Tampilkan',['class'=>'btn btn-success']) !!}
					{!! Form::close() !!}
				</div> -->
				<div>
					{!! Form::open(['url'=>'/admin/penagihan/tagihan-konsumen','method'=>'GET','class'=>'form-inline']) !!}
					<div class="form-group">
					{!! Form::label('konsumen','Daftar Konsumen',['class'=>'sr-only']) !!}
					<div class="input-group" style="background-color:@brand-info">
					<div class="input-group-addon">Daftar Konsumen</div>
					{!! Form::select('konsumen',$konsumen,$kon,['class'=>'form-control']) !!}
					</div>
					</div>
					{!! Form::submit('Tampilkan',['class'=>'btn btn-success']) !!}
					{!! Form::close() !!}
				</div>


				<!-- -->
				<center><h3>{{isset($title)?$title:''}}</h3></center>
				@if(isset($tagihan)) 
				<table id="data" class="dttable display responsive no-wrap" width="100%">
				<tbody>
				<?php $totresi=0;$totbiaya=0;$totdp=0;$totsisa=0; ?>
				@foreach($tagihan as $i=>$l)
				<tr align="right" class="lunas {{$l->status?'lunas':'belum'}}">
					<td align="left" width="20">{{$l->noresi}}</td>
					<td align="left">{{$l->konsumen->nama}}</td>
					<td width="30">{{\App\Helpers::currency($l->valongkir)}}</td>
					<td width="30">{{\App\Helpers::currency($l->valdp)}}</td>
					<td width="30">{{\App\Helpers::currency($l->valsisa)}}</td>
					<td width="10">{{$l->status?'Lunas':'Belum'}}</td>
					<td width="10" align="left">
						<a href="/admin/resi/{{$l->noresi}}" class="btn btn-success">Detail</a>
					</td>
				</tr>
				<?php
					$totbiaya += $l->valongkir;
					$totdp += $l->valdp;
					$totsisa += $l->valsisa;
				?>
				@endforeach
				</tbody>
				<thead>
				<tr>
					<th>No.Resi</th>
					<th>Konsumen</th>
					<th>Biaya</th>
					<th>DP</th>
					<th>Sisa</th>
					<th>Status</th>
					<th></th>
				</tr>
				</thead>
				<tfoot class="hidden-sm hidden-xs">
					<th>Total</th>
					<th></th>
					<th align="right">{{\App\Helpers::currency($totbiaya)}}</th>
					<th align="right">{{\App\Helpers::currency($totdp)}}</th>
					<th align="right">{{\App\Helpers::currency($totsisa)}}</th>
					<th></th>
					<th></th>
				</tfoot>
				</table>
				<div class="panel panel-danger hidden-md hidden-lg">
					<div class="panel-body">
						<div><b>Total Resi:</b> {{$totresi}} resi</div>
						<div><b>Total Biaya:</b> {{\App\Helpers::currency($totbiaya,2,'id')}}</div>
						<div><b>Total DP :</b> {{\App\Helpers::currency($totdp,2,'id')}}</div>
						<div><b>Total Sisa Tagihan:</b> {{\App\Helpers::currency($totsisa,2,'id')}}</div>
					</div>
				</div>
				@endif

			<table id="test">
				<thead>
					<tr>
						<td></td>
					</tr>
				</thead>
			</table>

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

$(document).ready(function() {
    var table = $('#tbkonsumen').DataTable();
 
    $('#tbkonsumen tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            alert($(this).find('td:first').text());
        }
    });
 	
    $('#button').click( function () {
        table.row('.selected').remove().draw( false );
    } );



	
	$('.dttable').dataTable({
		"order" : [0,"asc"],
		"iDisplayLength": 5,
		"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"responsive":true,
		"pagingType": "full",
		"language": language
	});


} );


</script>
@endsection

@section('help')
<p><b>Shortcut For Laporan Tagihan</b></p>
<hr>
<p>Tekan tombol ... untuk melakukan ...</p>


@endsection