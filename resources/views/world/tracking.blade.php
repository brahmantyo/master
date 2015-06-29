{!! Form::open(['role' => 'form', 'url' => '/tracking/search', 'method' => 'GET']) !!}
{!! Form::text('id','',['placeholder'=>'Masukan Nomer Resi']) !!}
{!! Form::submit('Cari') !!}
{!! Form::close() !!}
@if(isset($trackingreport)&&is_object($trackingreport))
	@if($trackingreport->count())
<hr>
<!-- 
			'noresi'=>'1000',
			'nmkonsumen'=>'PT.Maju Mundur',
			'asal'=>'bandung',
			'tujuan'=>'medan',
			'tglberangkat'=>'21-04-2015',
			'jamberangkat'=>'21:08:23',
			'tgltiba'=>'01-05-2015',
			'jamtiba'=>'08:22:32',
			'nopolisi'=>'D9028LE',
			'sopir'=>'paijo',
			'user'=>'nunung' 
		-->
<div class="table-responsive">
<table class="table table-condensed table-bordered no-margin" style="font-weight: bold">
	<tr><td class="info" width="200">Nomer Resi</td><td>{{ $trackingreport->noresi }}</td></tr>
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
		</tr>
	</tbody>
	<thead style="text-align:center;font-weight: bold">
		<tr>
			<td rowspan="2">Cabang Asal</td>
			<td rowspan="2">Cabang Tujuan</td>
			<td colspan="2">Armada</td>
			<td colspan="2">Berangkat</td>
			<td colspan="2">Tiba</td>
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
	@else
maaf resi tidak ditemukan
	@endif
@endif


