@extends('app-modal')

@section('style')
@endsection

@section('script')
@endsection

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <!-- put another before link if exist here -->
    <li class="active">Buat Quote Baru</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-notes'></i>Buat Quote Baru</h1>
                <hr>
            </div>
            <div class="box-body" width="50%">
            @if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{!! $error !!}</div>
                @endforeach
            @endif

            <style type="text/css">
            	fieldset.panel {
				    padding-left:10px;
				    padding-right: 10px;
				   	margin: 5px;
            	}

				fieldset.panel > legend:nth-child(1) {
					width: auto; /* Or auto */
				    padding:10px 10px; /* To give a bit of padding on the left and right */
				    border: none;
				    background-color: #daa;
				    border-radius: 10px;
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
					/*width:100%;*/
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
			@if(!$errors->has())
			{!! Form::open(['id'=>'form1','url'=>'order','method'=>'POST','class'=>'form-horizontal']) !!}
				{!! Form::hidden('pengirim',$pengirim) !!}
				<div class="col-md-12">
				<fieldset class=" panel panel-primary">
					<legend>Data Penerima</legend>
					<div class="form-group {{ $errors->has('penerima') ? 'has-error' : '' }}">
						{!! Form::label('penerima','Penerima',['class'=>'control-label col-md-2']) !!}
						<div class="col-md-10">
							{!! Form::select('penerima',$penerima,'',['class'=>'form-control','onchange'=>'getPenerima()']) !!}
							{!! $errors->first('penerima', '<p class="help-block">:message</p>') !!}
						</div>
					</div>
					<hr>
					<div class="form-group {{ $errors->has('cppenerima') ? 'has-error' : '' }} required">
						{!! Form::label('cppenerima','Contact Person',['class'=>'required control-label col-md-2']) !!}
						<div class="col-md-10">
							{!! Form::text('cppenerima',old('cppenerima'),['class'=>'form-control','required']) !!}
							{!! $errors->first('cppenerima', '<p class="help-block">:message</p>') !!}
						</div>
					</div>
					<div class="form-group {{ $errors->has('nppenerima') ? 'has-error' : '' }}">
						{!! Form::label('nppenerima','Nama Perusahaan',['class'=>'control-label col-md-2']) !!}
						<div class="col-md-10">
							{!! Form::text('nppenerima',old('nppenerima'),['placeholder'=>'Kosongkan jika penerima perorangan','class'=>'form-control']) !!}
							{!! $errors->first('nppenerima', '<p class="help-block">:message</p>') !!}
						</div>
					</div>
					<div class="form-group {{ $errors->has('emailpenerima') ? 'has-error' : '' }}">
						{!! Form::label('emailpenerima','Email',['class'=>'control-label col-md-2']) !!}
						<div class="col-md-10">
							{!! Form::email('emailpenerima',old('emailpenerima'),['placeholder'=>'Email pengirim','class'=>'form-control']) !!}
							{!! $errors->first('emailpenerima', '<p class="help-block">:message</p>') !!}
						</div>
					</div>
					<div class="form-group {{ $errors->has('notelppenerima' ? 'has-error' : '')}} required">
						{!! Form::label('notelppenerima','No. Telp',['class'=>'control-label col-md-2']) !!}
						<div class="col-md-10">
							{!! Form::text('notelppenerima',old('notelppenerima'),['placeholder'=>'Nomer telepon perusahaan/pribadi penerima','class'=>'form-control','required']) !!}
							{!! $errors->first('notelppenerima', '<p class="help-block">:message</p>') !!}
						</div>
					</div>
					<div class="form-group {{ $errors->has('alamatpenerima') ? 'has-error' : '' }} required">
						{!! Form::label('alamatpenerima','Alamat',['class'=>'control-label col-md-2']) !!}
						<div class="col-md-10">
							{!! Form::textarea('alamatpenerima',old('alamatpenerima'),['placeholder'=>'Alamat perusahaan penerima, alamat pribadi jika bukan perusahaan','class'=>'form-control','rows'=>'5']) !!}
							{!! $errors->first('alamatpenerima', '<p class="help-block">:message</p>') !!}
						</div>
					</div>
					<div class="form-group {{ $errors->has('kotapenerima') ? 'has-error' : '' }} required">
						{!! Form::label('kotapenerima','Kota',['class'=>'control-label col-md-2']) !!}
						<div class="col-md-10">
							{!! Form::select('kotapenerima',array_merge(['--Pilih Kota--'],$kota),old('kotapenerima'),['class'=>'form-control']) !!}
							{!! $errors->first('kotapenerima', '<p class="help-block">:message</p>') !!}
						</div>
					</div>
				</fieldset>

				<fieldset class="panel panel-primary">
					<legend>Data Pengiriman</legend>
					<div class="form-group {{ $errors->has('tagihan') ? 'has-error' : '' }}">
						{!! Form::label('tagihan','Penerima tagihan',['class'=>'control-label col-md-2']) !!}
						<div class="col-md-10">
							{!! Form::select('tagihan',['Pengirim'=>'Pengirim','Penerima'=>'Penerima'],old('tagihan'),['class'=>'form-control']) !!}
							{!! $errors->first('tagihan', '<p class="help-block">:message</p>') !!}
						</div>
					</div>
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
							{!! Form::input('date','tgljemput',old('tgljemput'),['class'=>'date form-control','placeholder'=>'dd-mm-yyyy']) !!}
							{!! $errors->first('tgljemput', '<p class="help-block">:message</p>') !!}
						</div>
					</div>
					<div class="form-group {{ $errors->has('tglterima') ? 'has-error' : '' }}">
						{!! Form::label('tglkirim','Tanggal Pengiriman',['class'=>'control-label col-md-2']) !!}
						<div class="col-md-10">
							{!! Form::input('date','tglkirim',old('tglkirim'),['class'=>'date form-control','placeholder'=>'dd-mm-yyyy']) !!}
							{!! $errors->first('tglkirim', '<p class="help-block">:message</p>') !!}
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-2"></div>
						<div class="col-md-10 checkbox">
							<label>
							<input type="checkbox" name="asalsama"/>
							<span  class="control-label">Centang jika data alamat dan kota asal sama dengan pengirim</span>
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
				
				<fieldset class="panel {{ $errors->has('items') ? 'panel-danger' : 'panel-info' }}">
					<legend class="{{ $errors->has('quote') ? 'text-danger' : '' }}">Rincian Item</legend>
					<div>
					<table class="table table-bordered" id="items">
						<tbody>
							<tr>
								<td><input name="nmbarang[0]" type="text" placeholder="Masukan nama atau keterangan barang di sini"></td>
								<td><input name="qty[0]" type="text" min="1" placeholder="Masukan jumlah/kuantitas" lang="id_ID" step="0.001"></td>
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
				</div>
			{!! Form::close() !!}
			@endif
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	var id=0;
	function getPenerima(){

		idpenerima = $('select[name="penerima"]').val();
		$.getJSON('/getkon/'+idpenerima, function(data){
			$('input[name="cppenerima"]').val(data.cp);
			$('input[name="nppenerima"]').val(data.nama);
			$('input[name="emailpenerima"]').val(data.email);
			$('input[name="notelppenerima"]').val(data.notelp);
			$('textarea[name="alamatpenerima"]').val(data.alamat);
			$('select[name="kotapenerima"]').val(data.kota);
		});
	}

	function addItem(){
		id++;
		nama = '<input type="text" name="nmbarang['+id+']"></input>';
		qty = '<input type="text" name="qty['+id+']" min="1" lang="id_ID" step="0.001"></input>';
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
    $('#form1').on('submit',function(e){
        e.preventDefault();
        $.ajaxSetup({
           headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
        var form = $(this);
        var dataString = form.serialize();
        var formAction = form.attr('action');

        //alert(dataString);
        $.ajax({
            url: formAction,
            type: 'POST',
            cache:false,
            data: dataString,
            dataType: 'json',
        	success: function(data){
        		if(data.error){
        			var info = BootstrapDialog.alert({
        				type: BootstrapDialog.TYPE_DANGER,
        				title: 'Ada kesalahan !',
        				message: data.message,
        				callback: function(){
        					this.close();
        				}
        			});
        		}else{
					var info = BootstrapDialog.alert({
						title: 'Informasi',
						message:'Penyimpanan sukses',
						callback:function(r){
        					if(r){
        						this.close();
        						parent.$.fancybox.close();
							}
						}
					});
				}
        	},
        });
    });
	$(document).on('ready',function(){
		$('input[type="date"]').datepicker({
	        format: "dd-mm-yyyy",
	        todayBtn: "linked",
	        clearBtn: true,
	        language: "id",
	        orientation: "auto left",
	        autoclose: true,
	        todayHighlight: true
		});
	});
</script>
@endsection

@section('help')
<p><b>Shortcut For ...</b></p>
<hr>
<p>Tekan tombol ... untuk melakukan ...</p>
@endsection