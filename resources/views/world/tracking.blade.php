{!! Form::open(['role' => 'form', 'url' => '/tracking/search', 'method' => 'GET']) !!}
{!! Form::text('id','',['placeholder'=>'Masukan Nomer Resi']) !!}
{!! Form::submit('Cari') !!}
{!! Form::close() !!}




<hr>
<div class="table-responsive">
<table class="table table-condensed table-bordered no-margin" style="font-weight: bold">
	<tr><td class="info" width="200">No. Resi</td><td>{{ $data->noresi }}</td></tr>
	<tr><td class="info" >Konsumen Pengirim</td><td>{{ $data->prspengirim?:$data->cppengirim }}</td></tr>
	<tr><td class="info" >Konsumen Penerima</td><td>{{ $data->prspenerima?:$data->cppenerima }}</td></tr>
</table>

<table class="table table-condensed table-striped table-bordered" width="100%">
	<tbody>
		<tr class="success" align="center">
			<td>{{ $data->idberangkat }}</td>
			<td>{{ $data->cabangasal }}</td>
			<td>{{ $data->cabangtujuan }}</td>
			<td>{{ $data->nopolisi }}</td>
			<td>{{ $data->supir1 }}</td>
			<td>{{ $data->supir2?:'-' }}</td>
			<td>{{ $data->tglbrkt=='0000-00-00'?'-':\App\Helpers::dateFromMySqlSystem($data->tglbrkt) }}</td>
			<td>{{ $data->tgltiba=='0000-00-00'?'-':\App\Helpers::dateFromMySqlSystem($data->tgltiba) }}</td>
		</tr>
	</tbody>
	<thead style="text-align:center;font-weight: bold">
		<tr>
			<td rowspan="2" width="100">No.SJT</td>
			<td rowspan="2" width="100">Cabang Asal</td>
			<td rowspan="2" width="100">Cabang Tujuan</td>
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
<center><b>Histori Lokasi Armada</b></center>
<table class="table table-condensed table-striped table-bordered" width="100%">
	<tbody>
		@foreach($posisi as $p)
		<tr>
			<td>{{ \App\Helpers::dateFromMySqlSystem($p->tgl) }}</td>
			<td>{{ $p->pukul }}</td>
			<td>{{ $p->lokasi }}</td>
		</tr>
		@endforeach
	</tbody>
	<thead>
		<th>Tanggal</th>
		<th>Jam</th>
		<th>Lokasi</th>
	</thead>
</table>
</div>
