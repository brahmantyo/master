@extends('app')
@section('content-header')
<ol class="breadcrumb">
	@if(\Auth::user()->level=='KONSUMEN')
    <li><a href="/konsumenpanel"><i class="fa fa-dashboard"></i>Home</a></li>
    @else
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    @endif
    <li class="active"><i class="fa fa-truck"></i>Daftar Permintaan Kirim (Quotation)</li>
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
				<span><h1><i class="fa fa-truck"></i>Daftar Permintaan Kirim (Quotation)</h1></span>
				<hr>
				@if(\Auth::user()->level=='KONSUMEN')
				<a id="tambah" href="/order/create" class="btn btn-success">Tambah Quote Baru</a>
				@endif
			</div>
			@if ($errors->has())
			@foreach ($errors->all() as $error)
			<div class='bg-danger alert'>{!! $error !!}</div>
			@endforeach
			@endif
			<div class="box-body">
				<table id="quotes" class="display responsive no-wrap" width="100%">
				<tbody>
					@foreach($quotes as $quote)
					<tr class="{{($quote->status)?'':'new-quote'}}">
						<td>{{\App\Helpers::dateFromMySqlSystem($quote->tglquote)}}</td>
						<td>{{$quote->id}}</td>
						<td>{{($quote->pengirim->nama!='-')&&$quote->pengirim->nama?$quote->pengirim->nama:$quote->pengirim->cp}}</td>
						<td>{{($quote->penerima->nama!='-')&&$quote->penerima->nama?$quote->penerima->nama:$quote->penerima->cp}}</td>
						<td>{{$quote->kota->nmkota}}</td>
						<td>{{$quote->tipe=='Borongan'?'Borongan':'Regular'}}</td>
						<td>{{(!$quote->status)?'Menunggu':'Sedang Proses'}}</td>
						<td>
							@if(\Auth::user()->level=='KONSUMEN')
	                        {!! Form::open(['url' =>'/order/'.$quote->id,'method'=>'DELETE']) !!}
							<a href="/order/{{$quote->id}}" class="btn btn-success">Lihat</a>
							@if($quote->status=='0')
	                        {!! Form::submit('Delete',['class'=>'btn btn-danger'])!!}
	                        @endif
	                        {!! Form::close() !!}
	                        @else
	                        {!! Form::open(['url' =>'/quotation/'.$quote->id,'method'=>'DELETE']) !!}
							<a href="/quotation/{{$quote->id}}" class="btn btn-success">Lihat</a>
	                        {!! Form::submit('Delete',['class'=>'btn btn-danger',($quote->status=='0'?'':'disabled')])!!}
	                        {!! Form::close() !!}
	                        @endif
						</td>
					</tr>
					@endforeach
				</tbody>
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>Quote No.</th>
						<th>Pengirim</th>
						<th>Penerima</th>
						<th>Kota Penerima</th>
						<th>Tipe</th>
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
$(document).ready(function(){
	$('a:contains("Lihat")').fancybox({
		type : 'iframe',
		href : this.value,
		height: 800,
		openSpeed: 1,
		closeSpeed: 1,
		ajax : {
			dataType : 'html',
		},
		@if(\Auth::user()->level=='KONSUMEN')
		afterClose : function(){ window.location.replace('/order') },
		@else
		afterClose : function(){ window.location.replace('/quotation') },
		@endif
	});
	$('#tambah').fancybox({
		type : 'iframe',
		href : this.value,
		
		width: 1000,
		height: 700,
		openSpeed: 1,
		closeSpeed: 1,
		ajax : {
			dataType : 'html',
		},
		helpers: {
			overlay: {
				locked: true,
				closeClick: false,
			},
		},
		@if(\Auth::user()->level=='KONSUMEN')
		afterClose : function(){ window.location.replace('/order') },
		@else
		afterClose : function(){ window.location.replace('/quotation') },
		@endif
	});

	$('#quotes').dataTable({
		"order" : [1,"desc"],
		"iDisplayLength": 5,
		"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"responsive": true,
		"pagingType" : "full_numbers",
	});
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