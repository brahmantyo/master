@extends('app')

@section('style')
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
@endsection

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <!-- put another before link if exist here -->
    <li class="active">Laporan History</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-tasks'></i> Laporan History Transaksi</h1>
                <hr>
            </div>
            <div class="box-body">
            @if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{!! $error !!}</div>
                @endforeach
            @endif

			<div class="box-body">
				<table id="histori" class="table table-responsive table-condensed table-bordered table-striped table-hover no-margin">
				<tbody>     <?php /*
					@foreach($historis as $histori)
					<tr class="{{($histori->status)?'':'new'}}">
						<td></td>
						<td></td>
						
					</tr>
					@endforeach    */   ?>
				</tbody>
				<thead>
					<tr>
						<th>No.</th>
						<th>Tanggal</th>
						
					</tr>
				</thead>
				</table>
			</div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$('#histori').dataTable({
	    	"order" : [1,"asc"],
		});
</script>
@endsection

@section('help')
<p><b>Shortcut For Laporan History</b></p>
<hr>
<p>Tekan tombol ... untuk melakukan ...</p>
@endsection