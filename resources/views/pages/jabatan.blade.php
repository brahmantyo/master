@extends('app-modal')
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active">Master Jabatan</li>
</ol>
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
		    	<span><h1><i class="fa fa-users"></i>Master Jabatan</h1></span>
		    	<hr>
		 	</div>
		 	@if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{!! $error !!}</div>
                @endforeach
            @endif
			<span><a class="btn btn-success" id="tambah" href="/jabatan/create">Tambah</a></span>		    	
		 	<div class="box-body table-responsive col-lg-12">
		        <table class="table table-condensed table-striped table-bordered table-hover no-margin">
					<thead>
						<tr style="font-weight: bold">
							<td>NAMA JABATAN</td>
							<td width="135"></td>
						</tr>
					</thead>
					<tbody>
						@foreach($jabatan as $list)
						<tr>
							<td>{{ $list->nmjabatan }}</td>
							<td>
								<a class="btn btn-info" href="/jabatan/edit/{{$list->idjabatan}}">Edit</a>
								<a class="btn btn-warning" href="/jabatan/delete/{{$list->idjabatan}}">Hapus</a>
							</td>
						</tr>
						@endforeach
					</tbody>
		        </table>
   		        {!! $jabatan->render() !!}
		    </div>
	 	</div>
	</div>
</div>
@endsection