@extends('app')
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active">Master Konsumen</li>
</ol>
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
		    	<div class="pull-left"><h1><i class="fa fa-users"></i>Master Konsumen</h1></div>
   			 	<div class="pull-right"><a class="btn btn-info" id="tambah" href="/konsumen/create">Tambah</a></div>
		 	</div>
		 	<div class="box-body table-responsive">
		        <table class="table table-condensed table-striped table-bordered table-hover no-margin">
					<thead>
						<tr style="font-weight: bold">
							<td>NAMA</td>
							<td>ALAMAT</td>
							<td>TELP</td>
							<td>CONTACT</td>
							<td>EMAIL</td>
							<td colspan="2"></td>
						</tr>
					</thead>
					<tbody>
						@foreach($konsumen as $list)
						<tr>
							<td>{{ $list->nama }}</td>
							<td>{{ $list->alamat }}</td>
							<td>{{ $list->notelp }}</td>
							<td>{{ $list->contactperson }}</td>
							<td>{{ $list->email }}</td>
							<td><a class="btn btn-info" href="/konsumen/edit/{{$list->idkonsumen}}">Edit</a></td>
							<td><a class="btn btn-warning" href="/konsumen/delete/{{$list->idkonsumen}}">Hapus</a></td>
						</tr>
						@endforeach
					</tbody>
		        </table>
   		        {!! $konsumen->render() !!}
		    </div>
	 	</div>
	</div>
</div>
@endsection