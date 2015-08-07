<div id="daftarBrg" class="col-md-12 panel panel-primary">
    <div class="panel-body">
        <div id="error"></div>
        <div class='form-group'>
            {!! Form::text('nmitem', old('nmitem'), ['placeholder' => 'Nama Item', 'class' => 'form-control']) !!}
        </div>
        <div class='form-group'>
            {!! Form::text('qty', old('qty'), ['placeholder' => 'Jumlah Item', 'class' => 'form-control']) !!}
        </div>
        <div class='form-group'>
            {!! Form::select('satuan',['kg'=>'Kg','ton'=>'Ton','koli'=>'Koli'],old('satuan'),['class' => 'form-control']) !!}
        </div>

        <div class='form-group'>
            {!! Form::button('Tambahkan', ['class' => 'btn btn-primary','onclick'=>'addItemToTable(\'tblItem\')']) !!}
        </div>

        {!! Form::open(['role' => 'form', 'id'=>'dtForm','url'=>'/order','_method'=>'POST']) !!}
        <div id="lsBrg" class="table-responsive" style="display:none">
            {!! Form::label('borongan','Borongan ?') !!}
            {!! Form::checkbox('borongan',1) !!} Ya
            <table id="tblItem" class="table table-bordered" >
                <tbody></tbody>
                <thead>
                    <tr>
                        <td>NO.</td>
                        <td>Nama Item</td>
                        <td>Jumlah</td>
                        <td>Satuan</td>
                        <td></td>
                    </tr>
                </thead>
            </table>
            @if(!Auth::guest())
            {!! Form::hidden('user',Auth::user()->id) !!}
            @endif
            <div class="form-group">
            {!! Form::submit('Lanjut',['id'=>'bLanjut','class'=>'btn btn-primary form-control']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <script type="text/javascript">
        var no = 0;
        
        function checkRule(name,item,rules){
            error = '';
            $(document).find('#error').replaceWith("<div id='error'></div>");

            rules = rules.split('|');
            for (rule of rules){
                switch(rule.trim()){
                    case 'required' :   if(!item.trim()){
                                            error +="<div class='bg-danger alert'>"+name+" tidak boleh kosong</div>";
                                        }
                                        break; //cek apakah item kosong
                    case 'number' :     if(isNaN(item)||item<1){
                                            error +="<div class='bg-danger alert'>"+name+" harus angka dan minimal 1</div>";
                                        }
                                        break; //cek apakah item tidak diisi dengan angka
                }
            }
            if(error){
                $('#error').append(error);
                return false;
            }else{
                //$(document).find('#error').replaceWith("<div id='error'></div>");
                return true;
            }
        }

        function getTableRow(table){
            return $('#'+table+' tr').length;
        }
        function addItemToTable(table){

            nmItem = $('input[name="nmitem"]').val();
            qty = $('input[name="qty"]').val();
            sat = $('select[name="satuan"]').val();
            if(checkRule('Nama Barang',nmItem,'required')&&checkRule('Jumlah Item',qty,'required|number')){
                if(!(getTableRow('tblItem tbody'))){
                    $('#lsBrg').show();
                };
                no++;
                var dt = "<tr>"
                            +"<td>"+no+"</td>"
                            +"<td><input name='nmItem["+no+"]' type='text' value='"+nmItem+"'/></td>"
                            +"<td><input name='qty["+no+"]' type='text' value='"+qty+"' /></td>"
                            +"<td><select name='satuan["+no+"]'><option value='kg'>Kg</option><option value='ton'>Ton</option><option value='koli'>Koli</option></select></td>"
                            +"<td><button onclick='delItemFromTable(this)'>Hapus</button></td></tr>";
                $('#'+table+' tbody').append(dt);
                $('#'+table+' select[name="satuan['+no+']"]').val(sat);

                $('input[name="nmitem"]').val('');
                $('input[name="qty"]').val('');
                //$('select[name="satuan"]').val('kg');
            }
        }
        function delItemFromTable(obj){
            $(obj).closest('tr').remove();
            if(!(getTableRow('tblItem tbody'))){
                $('#lsBrg').hide();
            };            
        }
        $('#dtForm').on('submit',function(e){
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
                data: dataString,
                success: function(data){
                    //no=0;
                    $('#tblItem tbody tr').remove();
                    $('#lsBrg').hide();
                    @if(Auth::guest())
                    alert('Login untuk Order. Bila belum terdftar silahkan mendaftar terlebih dahulu')
                    @else
                    alert('Data barang yang Anda order sudah tersimpan. Silahkan Klik Dashboard untuk melanjutkan');
                    @endif
                    //window.location.replace("/konsumen");
                    // $('#daftarBrg').hide();
                    // $('#daftarKonsumen').show();

                },
                error: function(a,b,c){
                    //var err = a.responseText;
                    alert('Ada kesalahan. Mohon dicek kembali.'+a);                 
                }
            },'json');
        });
    </script>
</div>
<hr>
@if(Auth::guest())
<div id="daftarKonsumen" class="col-md-12 panel panel-primary" style="">
	<div class='col-md-6'>
		Belum terdaftar? Silahkan isi form pendaftaran di bawah ini :
        <div class="box-body" width="50%">
        @if(isset($errorsorder))
            @if($errorsorder->has())
                @foreach ($errorsorder->all() as $error)
                <div class='bg-danger alert'>{!! $error !!}</div>
                @endforeach
            @endif
        @endif
        {!! Form::open(['role' => 'form', 'url' => '/order/daftar']) !!}
            <div class='form-group'>
                {!! Form::text('name', old('name'), ['placeholder' => 'Login ID', 'class' => 'form-control']) !!}
            </div>
            <div class='form-group'>
                {!! Form::email('email', old('email'), ['placeholder' => 'Email', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
				{!! Form::password('password',['placeholder'=>'Password']) !!}
				{!! Form::password('kpassword',['placeholder'=>'Konfirmasi Password']) !!}
            </div>
            <div class='form-group'>
                {!! Form::submit('Daftar', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
        </div>
	</div>
	<div class='col-md-6'>
    	Sudah terdaftar? Silahkan Masuk
    	{!! Form::open(['role'=>'form','url'=>'/auth/login']) !!}
    	{!! Form::text('name',old('name'),['placeholder'=>'Silahkan masukan Login Id']) !!}
    	{!! Form::password('password',['placeholder'=>'Password']) !!}
    	{!! Form::submit('Masuk') !!}
    	{!! Form::close() !!}
	</div>
</div>
@endif