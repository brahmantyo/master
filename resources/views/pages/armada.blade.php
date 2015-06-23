@extends('app')
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active">Master Armada</li>
</ol>
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
		    	<span><h1><i class="fa fa-truck"></i>Master Armada</h1></span>
		    	<hr>
				<span class="pull-right"><a class="btn btn-success	" id="tambah" href="/armada/create">Tambah</a></span>		    	
		 	</div>
		 	<div class="box-body table-responsive">
   			 	
		        <table class="table table-condensed table-striped table-bordered table-hover no-margin">
					<thead>
						<tr style="font-weight: bold">
							<td>NO POLISI</td>
							<td>JENIS KENDARAAN</td>
							<td>TAHUN PEMBUATAN</td>
							<td width="135"></td>
						</tr>
					</thead>
					<tbody>
						@foreach($armada as $list)
						<tr>
							<td>{{ $list->nopolisi }}</td>
							<td>{{ $list->jeniskendaraan }}</td>
							<td>{{ $list->tahun }}</td>
							<td>
								<a class="btn btn-info" href="/armada/edit/{{$list->nopolisi}}">Edit</a>
								<a class="btn btn-warning" href="/armada/delete/{{$list->nopolisi}}">Hapus</a>
							</td>
						</tr>
						@endforeach
					</tbody>
		        </table>
   		        {!! $armada->render() !!}
		    </div>
	 	</div>
	</div>
</div>
@endsection