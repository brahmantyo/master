@extends('app')
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/konsumenpanel"><i class="fa fa-dashboard"></i>Home</a></li>
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
				<a id="tambah" href="/order/create" class="btn btn-success">Tambah Quote Baru</a>
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
						<td><b>{{$quote->id}}</b></td>
						<td>{{($quote->pengirim->nama!='-')&&$quote->pengirim->nama?$quote->pengirim->nama:$quote->pengirim->cp}}</td>
						<td>{{($quote->penerima->nama!='-')&&$quote->penerima->nama?$quote->penerima->nama:$quote->penerima->cp}}</td>
						<td>{{$quote->tipe?'Borongan':'Regular'}}</td>
						<td>{{(!$quote->status)?'Menunggu':'Sedang Proses'}}</td>
						<td>
	                        {!! Form::open(['url' =>'/order/'.$quote->id,'method'=>'DELETE']) !!}
							<a href="/order/{{$quote->id}}" class="btn btn-success">Lihat</a>
	                        {!! Form::submit('Delete',['class'=>'btn btn-danger'])!!}
	                        {!! Form::close() !!}
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
	$('a:contains("Lihat")').fancybox({
		type : 'iframe',
		href : this.value,
		height: 800,
		openSpeed: 1,
		closeSpeed: 1,
		ajax : {
			dataType : 'html',
		},
		afterClose : function(){ window.location.replace('/order') },
	});
	$('#tambah').fancybox({
		type : 'iframe',
		href : this.value,
		
		width: 1000,
		height: 800,
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
		afterClose : function(){ window.location.replace('/order') },		
	});
	function afterSubmit() {
    	parent.$.fancybox.close();
	}
	$('#quotes').dataTable({
		"order" : [1,"desc"],
		"iDisplayLength": 5,
		"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"responsive": true,
		"pagingType" : "full_numbers",
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