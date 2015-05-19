@extends('app')

@section('content')
<div class="box">
	<div class="box-header" align="center"><h2>Laporan Mutasi Kas</h2></div>
	<div class="box-body">
		<div class="well">
		<form action="mutasi" method="post" role="form" class="form-inline">
			<div class="form-group">
			<label>Cabang</label>
			<select class="form-control">
				<option>Bandung</option>
				<option>Medan</option>
			</select>
			</div>
			<div class="form-group">
			<label>Periode</label>
			<input  class="form-control" type="date" placeholder="Tanggal Awal">
			<input  class="form-control" type="date" placeholder="Tanggal Akhir">
			</div>
			<button class="form-control" type="submit" >Search</button>
		</form>
		</div>

		<div>
		<table class="table table-condensed table-striped">
		<thead>
			<tr>
			<th>No.</th>
			<th>Tanggal</th>
			<th>Control</th>
			</tr>
		</thead>
		</table>
		</div>
	</div>
</div>
@endsection