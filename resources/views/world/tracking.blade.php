{!! Form::open(['role' => 'form', 'url' => '/tracking/search', 'method' => 'GET']) !!}
{!! Form::text('id','',['placeholder'=>'Masukan Nomer Resi']) !!}
{!! Form::submit('Cari') !!}
{!! Form::close() !!}

@if(isset($errorstracking))
	@if($errorstracking->has())
	    @foreach ($errorstracking->all() as $error)
	    <div class='bg-danger alert'>{!! $error !!}</div>
	    @endforeach
	@endif
@endif

@if(isset($trackingreport)&&is_object($trackingreport))
	@if($trackingreport->count())
<hr>
<div class="table-responsive">
<table class="table table-condensed table-bordered no-margin" style="font-weight: bold">
	<tr><td class="info" width="200">No. Resi</td><td>{{ $trackingreport->noresi }}</td></tr>
	<tr><td class="info" >Konsumen Pengirim</td><td>{{ $trackingreport->konsumen }}</td></tr>
</table>

<table class="table table-condensed table-striped table-bordered ">
	<tbody>
		<tr class="success">
			<td>{{ $trackingreport->asal }}</td>
			<td>{{ $trackingreport->tujuan }}</td>
			<td>{{ $trackingreport->nopolisi }}</td>
			<td>{{ $trackingreport->sopir }}</td>
			<td>{{ $trackingreport->tglberangkat }}</td>
			<td>{{ $trackingreport->jamberangkat }}</td>
			<td>{{ $trackingreport->tgltiba }}</td>
			<td>{{ $trackingreport->jamtiba }}</td>
			<td>{{ \App\Helpers::getResiStatus($trackingreport->status) }}</td>
		</tr>
	</tbody>
	<thead style="text-align:center;font-weight: bold">
		<tr>
			<td rowspan="2">Cabang Asal</td>
			<td rowspan="2">Cabang Tujuan</td>
			<td colspan="2">Armada</td>
			<td colspan="2">Berangkat</td>
			<td colspan="2">Tiba</td>
			<td rowspan="2">Status</td>
		</tr>
		<tr>
			<td>No.Polisi</td>
			<td>Sopir</td>
			<td>Tanggal</td>
			<td>Jam</td>
			<td>Tgl</td>
			<td>Jam</td>
		</tr>
	</thead>
</table>
</div>
	@endif
@endif