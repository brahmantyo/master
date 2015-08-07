<div>&nbsp;</div>
@if(Auth::guest())
<div id="step2a" class="col-md-12 panel panel-primary" style="">
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
        {!! Form::open(['id'=>'fStep2', 'role' => 'form', 'url' => '/order/daftar']) !!}
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
    	{!! Form::open(['id'=>'fLogin','role'=>'form','url'=>'/auth/login']) !!}
    	{!! Form::text('name',old('name'),['placeholder'=>'Silahkan masukan Login Id']) !!}
    	{!! Form::password('password',['placeholder'=>'Password']) !!}
    	{!! Form::submit('Masuk') !!}
    	{!! Form::close() !!}
	</div>
</div>
@else
<div id="step2b" class="panel panel-primary" style="">
	<div class="">
	Selamat datang <b>{{strtoupper(\Auth::user()->name)}}</b>. Silahkan tekan tombol Lanjut di bawah ini untuk meneruskan proses order.
	</div>
    {!! Form::button('Lanjut',['id'=>'bLanjut','class'=>'col-md-12 btn btn-primary form-control', 'onclick'=>'goToStep3()']) !!}
</div>
@endif

<!-- script -->
<script type="text/javascript">
    function goToStep3(){
        //$('a:contains("Resume")').removeClass('disabled');
        $('a:contains("Resume")').tab('show');
    }
    $('#fStep2').on('submit',function(e){
		e.preventDefault();
        $.ajaxSetup({
           headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
        var form = $(this);
        var dataString = form.serialize();

        var formAction = form.attr('action');
        $.ajax({
            url: formAction,
            type: 'POST',
            data: dataString,
            success: function(data){
				alert('Pendaftaran Berhasil');
            },
            error: function(a,b,c){
                alert('Ada kesalahan. Mohon dicek kembali.'+a);
            }
        },'json');
    });
    $('#fLogin').on('submit',function(e){
		e.preventDefault();
        $.ajaxSetup({
           headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
        var form = $(this);
        var dataString = form.serialize();

        var formAction = form.attr('action');
        $.ajax({
            url: formAction,
            type: 'POST',
            data: dataString,
            success: function(data){
				//goToStep3();
				window.location.replace('/?go=2');
            },
            error: function(a,b,c){
                alert('Ada kesalahan. Mohon dicek kembali.'+a);
            }
        },'json');
    });

</script>