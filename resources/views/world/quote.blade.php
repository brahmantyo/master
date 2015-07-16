@if(isset($successorder))
	<p>Terima Kasih telah mengirimkan order pengiriman kepada kami. </p>
	<p>Staff kami akan menghubungi Anda segera.</p>
	<p>Anda dapat melihat status order Anda dengan melihat di member area dengan memasukan data login sebagai berikut :</p>
	<div class="well">
	<h3>Nomer Quote : {{$quote}}</h3>
	<h3>User ID : {{$user['username']}}</h3>
	<h3>Password : {{$user['password']}}</h3>
	</div>
	<p>Mohon simpan baik-baik user id dan password Anda untuk dapat mengakses member area Anda dikemudian hari.</p>
	<p>Jika ada pertanyaan tentang order Anda, silahkan menghubungi cabang kami terdekat di :</p>
	<?php foreach ($cabang as $value): ?>
		<div><h3><b>{{$value->nama}}</b></h3></div>
		<div>{{$value->alamat}}</div>
		<div>{{$value->telp}}</div>
	<?php endforeach ?>
	<script type="text/javascript">
		$(document).ready(function(){
		   $('div#quote').hide();
		});
	</script>
@endif
<div id="quote">
<style type="text/css">
	fieldset.panel > legend:nth-child(1) {
		width: auto; /* Or auto */
	    padding:0 10px; /* To give a bit of padding on the left and right */
	    border-bottom: none;
	    margin-bottom: 5px;
	}

	#items input {
		width:100%;
		padding:5px;
		border: none;
	}
	#items input:focus,
	#items input.focus {
	  box-shadow: inset 1px 1px 2px 0 #c9c9c9;
	}
	#items select {
		width:100%;
		padding:5px;
		border: none;
	}
	#items select:focus,
	#items select.focus {
	  box-shadow: inset 1px 1px 2px 0 #c9c9c9;
	}

	.form-group.required .control-label:after { 
	    color: #d00;
	    content: "*";
	    position: absolute;
	    margin-left: 8px;
	    top:7px;
	    font-family: 'FontAwesome';
		font-weight: normal;
		font-size: 10px;
		content: "\f069";
	}
</style>
{!! Form::open(['url'=>'quote/create','class'=>'form-horizontal']) !!}
	<fieldset class="col-md-6">
		<legend>Data Personal</legend>
		<div class="form-group {{ $errors->has('nmdepan') ? 'has-error' : '' }} required">
			{!! Form::label('nmdepan','Nama Depan',['class'=>'required control-label col-md-4']) !!}
			<div class="col-md-8">
				{!! Form::text('nmdepan',old('nmdepan'),['placeholder'=>'Nama depan contact person','class'=>'form-control','required']) !!}
				{!! $errors->first('nmdepan', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('nmbelakang','Nama Belakang',['placeholder'=>'Nama belakang contact person','class'=>'control-label col-md-4']) !!}
			<div class="col-md-8">
				{!! Form::text('nmbelakang',old('nmbelakang'),['class'=>'form-control']) !!}
				{!! $errors->first('nmbelakang', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('nmperusahaan','Nama Perusahaan',['placeholder'=>'Kosongkan jika pengiriman pribadi','class'=>'control-label col-md-4']) !!}
			<div class="col-md-8">
				{!! Form::text('nmperusahaan',old('nmperusahaan'),['class'=>'form-control']) !!}
				{!! $errors->first('nmperusahaan', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
		<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} required">
			{!! Form::label('email','Email',['class'=>'control-label col-md-4']) !!}
			<div class="col-md-8">
				{!! Form::email('email',old('email'),['placeholder'=>'Email pengirim wajib diisi','class'=>'form-control','required']) !!}
				{!! $errors->first('email', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
		<div class="form-group {{ $errors->has('notelp') ? 'has-error' : '' }} required">
			{!! Form::label('notelp','No. Telp',['class'=>'control-label col-md-4']) !!}
			<div class="col-md-8">
				{!! Form::text('notelp',old('notelp'),['placeholder'=>'Nomer telepon perusahaan/pribadi pengirim (wajib diisi)','class'=>'form-control','required']) !!}
				{!! $errors->first('notelp', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
		<div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }} required">
			{!! Form::label('alamat','Alamat',['class'=>'control-label col-md-4']) !!}
			<div class="col-md-8">
				{!! Form::textarea('alamat',old('alamat'),['placeholder'=>'Alamat perusahaan pengirim atau alamat pribadi jika bukan perusahaan','class'=>'form-control','rows'=>'5','required']) !!}
				{!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
		<div class="form-group {{ $errors->has('kota') ? 'has-error' : '' }} required">
			{!! Form::label('kota','Kota',['class'=>'control-label col-md-4']) !!}
			<div class="col-md-8">
				{!! Form::select('kota',array_merge(['--Pilih Kota--'],$kota),old('kota'),['class'=>'form-control','required']) !!}
				{!! $errors->first('kota', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
	</fieldset>
	<fieldset class="col-md-6">
		<legend>Data Penerima</legend>
		<div class="form-group {{ $errors->has('cppenerima') ? 'has-error' : '' }} required">
			{!! Form::label('cppenerima','Contact Person',['class'=>'required control-label col-md-4']) !!}
			<div class="col-md-8">
				{!! Form::text('cppenerima',old('cppenerima'),['class'=>'form-control','required']) !!}
				{!! $errors->first('cppenerima', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
		<div class="form-group {{ $errors->has('nppenerima') ? 'has-error' : '' }}">
			{!! Form::label('nppenerima','Nama Perusahaan',['class'=>'control-label col-md-4']) !!}
			<div class="col-md-8">
				{!! Form::text('nppenerima',old('nppenerima'),['placeholder'=>'Kosongkan jika penerima perorangan','class'=>'form-control']) !!}
				{!! $errors->first('nppenerima', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
		<div class="form-group {{ $errors->has('emailpenerima') ? 'has-error' : '' }}">
			{!! Form::label('emailpenerima','Email',['class'=>'control-label col-md-4']) !!}
			<div class="col-md-8">
				{!! Form::email('emailpenerima',old('emailpenerima'),['placeholder'=>'Email pengirim','class'=>'form-control']) !!}
				{!! $errors->first('emailpenerima', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
		<div class="form-group {{ $errors->has('notelppenerima' ? 'has-error' : '')}} required">
			{!! Form::label('notelppenerima','No. Telp',['class'=>'control-label col-md-4']) !!}
			<div class="col-md-8">
				{!! Form::text('notelppenerima',old('notelppenerima'),['placeholder'=>'Nomer telepon perusahaan/pribadi penerima','class'=>'form-control','required']) !!}
				{!! $errors->first('notelppenerima', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
		<div class="form-group {{ $errors->has('alamatpenerima') ? 'has-error' : '' }} required">
			{!! Form::label('alamatpenerima','Alamat',['class'=>'control-label col-md-4']) !!}
			<div class="col-md-8">
				{!! Form::textarea('alamatpenerima',old('alamatpenerima'),['placeholder'=>'Alamat perusahaan penerima, alamat pribadi jika bukan perusahaan','class'=>'form-control','rows'=>'5']) !!}
				{!! $errors->first('alamatpenerima', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
		<div class="form-group {{ $errors->has('kotapenerima') ? 'has-error' : '' }} required">
			{!! Form::label('kotapenerima','Kota',['class'=>'control-label col-md-4']) !!}
			<div class="col-md-8">
				{!! Form::select('kotapenerima',array_merge(['--Pilih Kota--'],$kota),old('kotapenerima'),['class'=>'form-control']) !!}
				{!! $errors->first('kotapenerima', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
	</fieldset>
	<fieldset class="col-md-12">
		<legend>Data Pengiriman</legend>
		<div class="form-group {{ $errors->has('tipe') ? 'has-error' : '' }}">
			{!! Form::label('tipe','Tipe Kiriman',['class'=>'control-label col-md-2']) !!}
			<div class="col-md-10">
				{!! Form::select('tipe',['Regular'=>'Regular','Borongan'=>'Borongan'],old('tipe'),['class'=>'form-control']) !!}
				{!! $errors->first('tipe', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
		<div class="form-group {{ $errors->has('tgljemput') ? 'has-error' : '' }}">
			{!! Form::label('tgljemput','Tanggal Penjemputan (Pick Up)',['class'=>'control-label col-md-2']) !!}
			<div class="col-md-10">
				{!! Form::date('tgljemput',old('tgljemput'),['class'=>'date form-control','placeholder'=>'dd-mm-yyyy']) !!}
				{!! $errors->first('tgljemput', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
		<div class="form-group {{ $errors->has('tglterima') ? 'has-error' : '' }}">
			{!! Form::label('tglkirim','Tanggal Pengiriman',['class'=>'control-label col-md-2']) !!}
			<div class="col-md-10">
				{!! Form::date('tglkirim',old('tglkirim'),['class'=>'date form-control','placeholder'=>'dd-mm-yyyy']) !!}
				{!! $errors->first('tglkirim', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-2"></div>
			<div class="col-md-10 checkbox">
				<label>
				<input type="checkbox" name="asalsama"/>
				<span  class="control-label">Kosongkan centang jika alamat asal TIDAK SAMA dengan data pengirim</span>
				</label>
			</div>
		</div>
		<div class="form-group {{ $errors->has('alamatasal') ? 'has-error' : '' }}">
			{!! Form::label('alamatasal','Alamat Asal',['class'=>'control-label col-md-2']) !!}
			<div class="col-md-10">
				{!! Form::textarea('alamatasal','',['placeholder'=>'Alamat asal kiriman','class'=>'form-control','rows'=>'5']) !!}
				{!! $errors->first('alamatasal', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
		<div class="form-group {{ $errors->has('kotaasal') ? 'has-error' : '' }}">
			{!! Form::label('kotaasal','Kota Asal',['class'=>'control-label col-md-2']) !!}
			<div class="col-md-10">
				{!! Form::select('kotaasal',array_merge(['--Pilih Kota--'],$kota),old('kotaasal'),['class'=>'form-control']) !!}
				{!! $errors->first('kotaasal', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
	</fieldset>
	
	<fieldset class="panel {{ $errors->has('quote') ? 'panel-danger' : 'panel-info' }} col-md-12">
		<legend class="{{ $errors->has('quote') ? 'text-danger' : '' }}">Rincian Item</legend>
		<div>
		<table class="table table-bordered" id="items">
			<tbody>
				<tr>
					<td><input name="nmbarang[0]" type="text" placeholder="Masukan nama atau keterangan barang di sini"></td>
					<td><input name="qty[0]" type="number" min="1" placeholder="Masukan jumlah/kuantitas"></td>
					<td>
						<select name="satuan[0]">
						@foreach($satuan as $k=>$s)
						<option value="{{$k}}">{{$s}}</option>
						@endforeach
						</select>
					</td>
					<td><button onclick="removeItem(this)">Hapus</button></td>
				</tr>
			</tbody>
			<thead>
				<tr>
					<th>Nama Barang</th>
					<th>Jumlah</th>
					<th>Satuan</th>
					<th></th>
				</tr>
			</thead>
		</table>
			<div class="form-group">
				<div class="col-md-12">
					<div class="col-md-4"></div>
					{!! Form::button('Tambah Item',['onclick'=>'addItem()','class'=>'btn btn-success col-md-2']) !!}
					{!! Form::submit('Kirim Permintaan Order',['class'=>'btn btn-info col-md-2']) !!}
					<div class="col-md-4"></div>
				</div>
			</div>
		</div>
	</fieldset>
{!! Form::close() !!}
<script type="text/javascript">
	@if(isset(\Auth::user()->id))
	<?php $konsumen = \DB::table('konsumen')->where('iduser','=',\Auth::user()->id)->first(); ?>
	@if($konsumen)
	$('input[name="nmdepan"]').val('{{\Auth::user()->first_name}}').prop('disabled',true);
	$('input[name="nmbelakang"]').val('{{\Auth::user()->last_name}}').prop('disabled',true);
	$('input[name="nmperusahaan"]').val('{{$konsumen->nama}}').prop('disabled',true);
	$('input[name="email"]').val('{{$konsumen->email}}').prop('disabled',true);
	$('input[name="notelp"]').val('{{$konsumen->notelp}}').prop('disabled',true);
	$('textarea[name="alamat"]').val('{{$konsumen->alamat}}').prop('disabled',true);
	$('select[name="kota"]').val('{{$konsumen->kota}}').prop('disabled',true);
	@endif
	@endif
	var id=0;
	function addItem(){
		id++;
		nama = '<input type="text" name="nmbarang['+id+']"></input>';
		qty = '<input type="number" name="qty['+id+']" min="1"></input>';
		unit = '<select name="satuan['+id+']">'+
				@foreach($satuan as $k=>$s)
				'<option value="{{$k}}">{{$s}}</option>'+
				@endforeach
				'</select>';
		lastRow = $('#items tbody:last');
		lastRow.append('<tr><td>'+nama+'</td><td>'+qty+'</td><td>'+unit+'</td><td><button onclick="removeItem(this)">Hapus</button></td></tr>');
		lastRow.find('tr:last td:first input').focus();
	}
	function removeItem(obj){
		$(obj).closest('tr').remove();
		$('button:contains("Tambah")').focus();
	}
	$('input[type="date"]').datepicker({
        format: "dd-mm-yyyy",
        todayBtn: "linked",
        clearBtn: true,
        language: "id",
        orientation: "auto left",
        autoclose: true,
        todayHighlight: true
	});
	$('textarea[name="alamatasal"]').prop('disabled',true);
	$('select[name="kotaasal"]').prop('disabled',true);
	$('input[name="asalsama"]:checkbox')
	.prop('checked',true)
	.on('change',function(){
		if($(this).is(':checked')){
			$('textarea[name="alamatasal"]').prop('disabled',true);
			$('select[name="kotaasal"]').prop('disabled',true);
		}else{
			$('textarea[name="alamatasal"]').prop('disabled',false);
			$('select[name="kotaasal"]').prop('disabled',false);
		}
	});
/*	$.get('/getkota').done(function(kota){
		var opsiKota='';
		$.each(kota, function(k,v){
			opsiKota+='<option value="'+v.idkota+'">'+v.nmkota+'</option>';
		});
		$('select[name="kota"]').append(opsiKota);
		$('select[name="kotaasal"]').append(opsiKota);
		$('select[name="kotatujuan"]').append(opsiKota);
	});*/
</script>
</div>