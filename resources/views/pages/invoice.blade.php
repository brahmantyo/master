@extends('laporan')
@section('content-header')
<h1>
Penjualan
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Penjualan</li>
</ol>
@endsection
@section('content')
	<div class="row">
		<div class="col-xs-12">

			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Laporan Penjualan</h3>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-condensed table-striped table-bordered table-hover no-margin" id="datapenjualan">
						<tr>
							<th>Part</th>
							<th>Serial No.</th>
							<th>Price</th>
							<th>Qty</th>
						</tr>
						<tr>
							<th>Part</th>
							<th>Serial No.</th>
							<th>Price</th>
							<th>Qty</th>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection

