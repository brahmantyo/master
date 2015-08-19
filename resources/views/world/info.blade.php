@extends('app-modal')

@section('content')
<div class="row">
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
	        <b>{{ strtoupper($dinfo->title) }}</b>
	    </div>
        <div class="panel-body">
			<p>{!! $dinfo->content !!}</p>
        </div>
        <div class="panel-footer"><span class="text text-primary small"><i>{{ ucfirst($dinfo->first_name) }} {{ ucfirst($dinfo->last_name) }}</i></span></div>
        <div><a href="#" class="btn btn-success" onclick="window.close()">Tutup</a></div>
        <div>&nbsp;</div>
    </div>
</div>
</div>
@endsection