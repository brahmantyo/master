{!! Form::open(['role' => 'form', 'url' => '/tracking/search', 'method' => 'GET']) !!}
{!! Form::text('id','',['placeholder'=>'Masukan Nomer Resi']) !!}
{!! Form::submit('Cari') !!}
{!! Form::close() !!}



@if(isset($trackingreport)&&is_object($trackingreport))
	@if($trackingreport->count())
<hr>
<div class="table-responsive">
<table class="table table-condensed table-bordered no-margin" style="font-weight: bold">
	<tr><td class="info" width="200">No. Resi</td><td>{{ $trackingreport->noresi }}</td></tr>
	<tr><td class="info" >Konsumen Pengirim</td><td>{{ $trackingreport->konsumen }}</td></tr>
</table>

<table class="table table-condensed table-striped table-bordered" width="100%">
	<tbody>
		<tr class="success">
			<td>{{ $trackingreport->asal }}</td>
			<td>{{ $trackingreport->tujuan }}</td>
			<td>{{ $trackingreport->nopolisi }}</td>
			<td>{{ $trackingreport->sopir }}</td>
			<td>{{ $trackingreport->tglberangkat }}</td>
			<td>{{ $trackingreport->tgltiba }}</td>
			<td>{{ \App\Helpers::getResiStatus($trackingreport->status) }}</td>
		</tr>
	</tbody>
	<thead style="text-align:center;font-weight: bold">
		<tr>
			<td rowspan="2">Cabang Asal</td>
			<td rowspan="2">Cabang Tujuan</td>
			<td colspan="2">Armada</td>
			<td >Berangkat</td>
			<td >Tiba</td>
			<td rowspan="2">Status</td>
		</tr>
		<tr>
			<td>No.Polisi</td>
			<td>Sopir</td>
			<td>Tanggal</td>
			<td>Tanggal</td>
		</tr>
	</thead>
</table>
</div>
	@endif
@endif