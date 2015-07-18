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
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <!-- put another before link if exist here -->
    <li class="active">Laporan Tagihan</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-credit-card'></i> {!!$title!!}</h1>
                <div class="">
                	{!! Form::open(['url'=>'#','class'=>'form-inline']) !!}
                		<fieldset class="col-md-12 well">
            				<div class="form-group {{ $errors->has('cabang') ? 'has-error' : '' }} ">
            					{!! Form::label('cabang','Cabang',['class'=>'control-label  col-md-12']) !!}
            					<div class="col-md-12">
            						{!! Form::select('cabang',array_merge(['--Pilih Cabang--'],$cabang),old('cabang'),['placeholder'=>'Cabang','class'=>'form-control','']) !!}
            						{!! $errors->first('cabang', '<p class="help-block">:message</p>') !!}
            					</div>
            				</div>
            				<div class="form-group  {{ $errors->has('tanggal') ? 'has-error' : '' }} ">
            					{!! Form::label('tanggal','Tanggal',['class'=>'control-label  col-md-12']) !!}
            					<div class="col-md-12">
            						{!! Form::date('tanggal',old('tanggal'),['placeholder'=>'Pilih range tanggal','class'=>'form-control','onclick'=>'this.preventDefault()']) !!}
            						{!! $errors->first('tanggal', '<p class="help-block">:message</p>') !!}
            					</div>
            					<script type="text/javascript">
            						$('input[name="tanggal"][type="date"]')
            							.daterangepicker({
										    "autoApply": true,
										    //"startDate": "{!!Date('Y/m/d')!!}",
										    //"minDate": "{!!Date('m-d-Y')!!}",
										    //"opens": "left",
										    //"drops": "down",
										    //"buttonClasses": "btn btn-sm",
										    //"applyClass": "btn-success",
										    //"cancelClass": "btn-default",
										    "locale" : {
										    	"format" : "YYYY/MM/DD"
										    },
										    'ranges' : {
										    	'Today': [moment(), moment()],
										    }
            							});
            					</script>
            				</div>
            				<div class="form-group {{ $errors->has('kota') ? 'has-error' : '' }} ">
            					{!! Form::label('tagihan','Penerima Tagihan',['class'=>'control-label  col-md-12']) !!}
            					<div class="col-md-12">
            						{!! Form::select('tagihan',array_merge(['--Pilih Penerima Tagihan--'],['Pengirim'=>'Pengirim','Penerima'=>'Penerima']),old('tagihan'),['placeholder'=>'Ditagihkan kepada','class'=>'form-control','']) !!}
            						{!! $errors->first('tagihan', '<p class="help-block">:message</p>') !!}
            					</div>
            				</div>
            				<div class="form-group">
            					{!! Form::submit('Filter',['class'=>'btn btn-info btn-lg']) !!}
            				</div>
                		</fieldset>
                	{!! Form::close() !!}
                </div>
            </div>
            <div class="box-body">
            @if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{!! $error !!}</div>
                @endforeach
            @endif
			<div class="box-body">
				<table id="tbtagihan" class="display responsive no-wrap" width="100%">
				<tbody>
					@foreach($tagihans as $tagihan)
					<tr class="{{($tagihan->status)?'':'new'}}" align="right">
						<td align="left">{{$tagihan->noresi}}</td>
						<td>{{\App\Helpers::dateFromMySqlSystem($tagihan->tglresi)}}</td>
						<td align="left">{{$tagihan->ppengirim?$tagihan->ppengirim:$tagihan->cpengirim}}</td>
						<td align="left">{{$tagihan->ppenerima?$tagihan->ppenerima:$tagihan->cpenerima}}</td>
						<td>{{\App\Helpers::currency($tagihan->totalbiaya)}}</td>
						<td>{{\App\Helpers::currency($tagihan->dp)}}</td>
						<td>{{\App\Helpers::currency($tagihan->sisa)}}</td>
						<td>{{$tagihan->tagihan}}</td>
						<td>
							<a href="/penagihan/{{$tagihan->noresi}}" class="btn btn-warning">View</a>
						</td>
					</tr>
					@endforeach
				</tbody>
				<thead>
					<tr>
						<th>No.Resi</th>
						<th>Tanggal</th>
						<th>Pengirim</th>
						<th>Penerima</th>
						<th>Biaya</th>
						<th>DP</th>
						<th>Sisa Tagihan</th>
						<th>Penagihan Kepada</th>
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
	$('#tbtagihan').dataTable({
		"order" : [1,"asc"],
		"iDisplayLength": 5,
		"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"responsive":true
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