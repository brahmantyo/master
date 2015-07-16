@extends('app')
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
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
			</div>
			@if ($errors->has())
			@foreach ($errors->all() as $error)
			<div class='bg-danger alert'>{!! $error !!}</div>
			@endforeach
			@endif
			<div class="box-body">
<!-- 				<div class="form-control"><b>Cari: </b><input type="text" name="search"></div> -->
				<table id="quotes" class="table table-responsive table-condensed table-bordered table-striped table-hover no-margin">
				<tbody>
					@foreach($quotes as $quote)
					<tr class="{{($quote->status)?'':'new-quote'}}">
						<td>{{$quote->tglquote}}</td>
						<td><b>{{$quote->id}}</b></td>
						<td>{{$quote->ppengirim?$quote->ppengirim:$quote->cppengirim}}</td>
						<td>{{$quote->ppenerima?$quote->ppenerima:$quote->cppenerima}}</td>
						<td>{{$quote->tipe?'Borongan':'Regular'}}</td>
						<td>{{(!$quote->status)?'Menunggu':'Sedang Proses'}}</td>
						<td>
							@if(\Auth::user()->level=='KONSUMEN')
							<a href="/quote/{{$quote->id}}" class="btn btn-warning">View</a>
							@else
							<a href="/quotation/{{$quote->id}}" class="btn btn-warning">View</a>
							<a href="#" class="btn btn-danger disabled">Delete</a>
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
		afterClose : function(){ window.location.replace('/quote') },
		@else
		afterClose : function(){ window.location.replace('/quotation') },
		@endif
	});
	$('#quotes').dataTable({
		    	"order" : [1,"asc"],
		    	"page" : 5,
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