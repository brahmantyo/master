@extends('app')

@section('content')
@if($cekprofil)
<div class="row">
    <div class="col-xs-12">
        <div class="box">
			<div class="box-body table-responsive">
				@if($torder)
            	{!! Form::open(['role' => 'form', 'url' => '/konsumenpanel/save']) !!}
				@foreach($torder as $id=>$order)
				<div class="panel panel-warning">
					<div class="panel-heading">
						<table class="table no-margin">
							<tr align="left"><td width="100">No.Order</td><td width="1">:</td><td>{{$id}}</td></tr>
							<tr><td>Borongan</td><td>:</td><td>{{$order['borongan']?'Ya':'Tidak'}}</td></tr>
						</table>
					</div>
					<div class="panel-body">
						<table class="table table-condensed table-striped table-bordered table-hover no-margin">
							<tbody>
								@foreach($order['items'] as $t)
								<tr>
									<td>{{ $t['tgl'] }}</td>
									<td>{{ $t['nmbarang'] }}</td>
									<td>{{ $t['qty'] }}</td>
									<td>{{ ucfirst($t['satuan']) }}</td>
									<td>{!! Form::checkbox('item[]',$t['id']) !!}</td>
								</tr>
								@endforeach
							</tbody>
							<thead>
								<tr>
									<td>Tgl</td>
									<td>Nama Item</td>
									<td>Qty</td>
									<td>Satuan</td>
									<td>Pilih Item</td>
								</tr>
							</thead>
						</table>
					</div>
				</div>
				@endforeach
				{!! Form::submit('SIMPAN KE DRAFT') !!}
				{!! Form::close() !!}
				@endif
				<hr>
				@if($uorder)
				<center><h3>Draft Order</h3></center>
				@foreach($uorder as $id=>$order)
				<div class="panel panel-primary">
					<div class="panel-heading">
						<table class="table no-margin">
							<tr align="left"><td width="100">No.Order</td><td width="1">:</td><td>{{$id}}</td></tr>
							<tr><td>Borongan</td><td>:</td><td>{{$order['borongan']?'Ya':'Tidak'}}</td></tr>
						</table>
					</div>
					<div class="panel-body">
						<table class="table table-condensed table-striped table-bordered table-hover no-margin">
							<tbody>
							@foreach($order['items'] as $t)
								<tr>
									<td>{{ $t['tgl'] }}</td>
									<td>{{ $t['nmbarang'] }}</td>
									<td>{{ $t['qty'] }}</td>
									<td>{{ ucfirst($t['satuan']) }}</td>
								</tr>
							@endforeach
							</tbody>
							<thead>
								<tr>
									<td>Tgl</td>
									<td>Nama Item</td>
									<td>Qty</td>
									<td>Satuan</td>
								</tr>
							</thead>
						</table>
					</div>
				</div>
				@endforeach
				@endif	
			</div>
		</div>
	</div>
</div>
@else
<a href="/profil" class="btn btn-primary">Harap lengkapi daftar profile anda</a>
@endif
@endsection