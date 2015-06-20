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
		    	<h1><i class="fa fa-users"></i>Master Konsumen</h1>
		 	</div>
		 	<div class="box-body table-responsive">
		        <table class="table table-condensed table-striped table-bordered table-hover no-margin">
					<thead>
						<tr>
							<td>Nama</td>
							<td>Alamat</td>
							<td>Telp</td>
							<td>Contact</td>
							<td>Email</td>
						</tr>
					</thead>
					<tbody>
						@foreach($konsumen as $list)
						<tr>
							<td>{{ $list->nama }}</td>
							<td>{{ $list->alamat }}</td>
							<td>{{ $list->telp }}</td>
							<td>{{ $list->contactperson }}</td>
							<td>{{ $list->email }}</td>
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