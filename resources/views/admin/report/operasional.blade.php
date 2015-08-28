@extends('app')

@section('style')
<link href="{{ asset('/plugins/daterangepicker2/daterangepicker.css') }}" rel="stylesheet" type="text/css" /> 
<link href="{{ asset('/plugins/datatables/jquery.dataTables.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/plugins/datatables/dataTables.responsive.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />


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

@endsection
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <!-- put another before link if exist here -->
    <li class="active">Laporan Biaya Operasional</li>
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
					<div class="col-md-12">
						{!! Form::open(['url'=>'/admin/operasional/operasional-cabang','method'=>'POST','class'=>'form-inline']) !!}
						<div class="form-group">
						{!! Form::label('cab','Daftar cabang',['class'=>'sr-only']) !!}
						<div class="input-group">
						
						{!! Form::select('cab',$cabang,Input::get('cab'),['class'=>'form-control']) !!}
						</div>
						</div>
						{!! Form::submit('Tampilkan',['class'=>'btn btn-success']) !!}
						{!! Form::close() !!}
					</div>
{{--					<div class="col-md-6"> --}}
{{--						{!! Form::open(['url'=>'/admin/operasional/operasional-tanggal','method'=>'POST','class'=>'form-inline']) !!} --}}
{{--						<div class="form-group"> --}}
{{--						{!! Form::label('tgl','Tanggal',['class'=>'sr-only']) !!} --}}
{{--						<div class="input-group"> --}}
{{--						 --}}
{{--						{!! Form::text('tgl','',['class'=>'date form-control']) !!} --}}
{{--						</div> --}}
{{--						</div> --}}
{{--						{!! Form::submit('Tampilkan',['class'=>'btn btn-success']) !!} --}}
{{--						{!! Form::close() !!} --}}
{{--					</div> --}}
					<!-- -->
					<center><h3>{{isset($title)?$title:''}}</h3></center>
					<table id="dataTable" class="display responsive no-wrap" width="100%">
						<tbody>
							<?php $jml=0; ?>
							@foreach($list as $l)
							<tr>
								<td>{{ $l->cabang->nama }}</td>
								<td>{{ \App\Helpers::dateFromMySqlSystem($l->tanggal) }}</td>
								<td>{{ $l->keterangan }}</td>
								<td align="right">{{ \App\Helpers::currency($l->nilai,2,'id') }}</td>
								<td>{{ \App\Helpers::getOperasionalStatus($l->status)}}</td>
								<td>{{ $l->users }}</td>
							</tr>
							<?php $jml += $l->nilai; ?>
							@endforeach
						</tbody>
						<thead>
							<tr>
								<th>Cabang</th>
								<th>Tanggal</th>
								<th>Keterangan</th>
								<th>Nilai</th>
								<th>Status</th>
								<th>User</th>
							</tr>
						</thead>
						<tfoot>
							<tr align="right">
								<td></td>
								<td></td>
								<td></td>
								<td>{{\App\Helpers::currency($jml,2,'id')}}</td>
								<td></td>
								<td></td>
							</tr>
						</tfoot>
					</table>
				</div>
            </div>
        </div>
    </div>
</div>				

<script type="text/javascript">
	$(document).ready(function(){
	    //Date range picker
	    $('.date').daterangepicker({
	    	"opens": "left"
	    });

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

		$('#dataTable').dataTable({
			
		});



	});
</script>
@endsection

@section('help')
<p><b>Shortcut For Laporan Biaya</b></p>
<hr>
<p>Tekan tombol ... untuk melakukan ...</p>

@endsection
