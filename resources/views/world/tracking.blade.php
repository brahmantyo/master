{!! Form::open(['role' => 'form', 'url' => '/tracking/search', 'method' => 'GET']) !!}
{!! Form::text('id','',['placeholder'=>'Masukan Nomer Resi']) !!}
{!! Form::submit('Cari') !!}
{!! Form::close() !!}



@if(isset($resi))
<hr>
<div class="table-responsive">
<table class="table table-condensed table-bordered no-margin" style="font-weight: bold">
	<tr><td class="info" width="200">No. Resi</td><td>{{ $resi->noresi }}</td></tr>
	<tr><td class="info" >Konsumen Pengirim</td><td>{{ $resi->pengirim->nama?$resi->pengirim->nama:$resi->pengirim->cp }}</td></tr>
</table>

<table class="table table-condensed table-striped table-bordered" width="100%">
	<tbody>
		<tr class="success" align="center">
			<td>{{ $keberangkatan->asal->nama }}</td>
			<td>{{ $keberangkatan->tujuan->nama }}</td>
			<td>{{ $keberangkatan->nopolisi }}</td>
			<td>{{ $keberangkatan->supir1 }}</td>
			<td>{{ $keberangkatan->supir2 }}</td>
			<td>{{ \App\Helpers::dateFromMySqlSystem($keberangkatan->tglberangkat) }}</td>
			<td>{{ \App\Helpers::dateFromMySqlSystem($keberangkatan->tgltiba) }}</td>
		</tr>
	</tbody>
	<thead style="text-align:center;font-weight: bold">
		<tr>
			<td rowspan="2">Cabang Asal</td>
			<td rowspan="2">Cabang Tujuan</td>
			<td colspan="3">Armada</td>
			<td >Berangkat</td>
			<td >Tiba</td>
		</tr>
		<tr>
			<td>No.Polisi</td>
			<td>Sopir 1</td>
			<td>Sopir 2</td>
			<td>Tanggal</td>
			<td>Tanggal</td>
		</tr>
	</thead>
</table>
</div>
@endif